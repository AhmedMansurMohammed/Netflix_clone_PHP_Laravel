<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function like(Request $request){
        $mediaId = $request->input('id_media');
        $user = auth()->user();
        $userId = $user->id_user;
        $user = User::find($userId);

        $media = Media::find($mediaId);

        if ($user->favoriteMedias->contains($media)) {
           
            $user->favoriteMedias()->detach($media);
            return true;
        } else {
         
            $user->favoriteMedias()->attach($media);
            return false;
        }

    }





    public function favorite(){
        // Obtenemos el ID del usuario actualmente autenticado
        $userId = auth()->id();
    
        // Verificamos si el usuario está autenticado
        if ($userId) {
            // Buscamos el usuario por su ID
            $user = User::find($userId);
    
            // Verificamos si se encontró el usuario
            if ($user) {
                // Obtenemos las medias favoritas del usuario
                $favoriteMedias = $user->favoriteMedias()->get();
                // Retornamos las medias favoritas a una vista
                return view('favorites', compact('favoriteMedias'));
            } else {
                // Si no se encontró el usuario, redireccionamos o retornamos un mensaje de error
                return redirect()->route('login')->with('error', 'Usuario no encontrado.');
            }
        } else {
            // Si el usuario no está autenticado, redireccionamos o retornamos un mensaje de error
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }
    }
    
}
