<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Media;

class EpisodesController extends Controller
{
    public function addEpisode($title, $url,$duration,$description,$id,$season=null,$idEpisode=null){
        if($idEpisode){
            $episode = Episode::find($idEpisode);
        }else{
            $episode = new Episode();
        }
        
        $episode->title = $title;
        $episode->url = $url;
        $episode->duration = $duration;
        $episode->description = $description;
        $episode->id_media = $id;
        $episode->season = $season;
        
        if (!$episode->save()) {
            throw new \Exception('Failed to save new episode.');
        }
        return $episode;
    }

    public function newEpisode(EpisodeRequest $request){
        try {
           $this->addEpisode(
                $request->input('title'),
                $request->input('url'),
                $request->input('duration'),
                $request->input('description'),
                $request->input('id_media'),
                $request->input('season'),
                $request->input('id')
            );
            return redirect()->route('admin.episodeList', ['id' => $request->input('id_media')])->with('success', 'Episode is create successfully!');
            
          
            
        } catch (\Exception $e) {
            return redirect()->route('admin.episodeList', ['id' => $request->input('id_media')])->with('error', $e->getMessage());
        }

    }


    public function getEpisodeList($id){
        $episodes = Episode::with( ['media'])
        ->where('id_media', $id)->get()->toArray();

      
    

        return view('adminPage/episodeList', ['episodes' => $episodes,'id_media'=>$id]);
        
    }

    public function getNewEpisodeForm($id){
        $media = Media::find($id);
        return view('adminPage/newEpisode', ['media' => $media]); 
    }

    public function getEpisodeEditForm($id){
        $episode = Episode::find($id);
        $media = Media::find($episode->id_media);
        return view('adminPage/editEpisode', ['episode' => $episode,'media' => $media]); 
    }

    public function seeVideo($id){
        $episode = Episode::find($id);
        $media = Media::find($episode->id_media);

        return view('video', ['episode' => $episode,'media' => $media]); 
    }


    public function deleteEpisode($id)
    {
        try {

            $episode = Episode::find($id);

            $id_media=$episode->id_media;
            $episode->delete();
            return redirect()->route('admin.episodeList',['id' => $id_media])->with('success', 'Episode is deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.episodeList',['id' => $id_media])->with('error', $e->getMessage());
        }
    }
}
