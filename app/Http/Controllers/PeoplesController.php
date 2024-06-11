<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Http\Requests\PeopleRequest;

class PeoplesController extends Controller
{

    public function deletePeople($id)
    {
        try {

            $person = People::find($id);

            $person->delete();
            return redirect()->route('admin.peopleList')->with('success', 'Person is deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.peopleList')->with('error', $e->getMessage());
        }
    }

    public function newPeople(PeopleRequest $request)
    {
        try {
            $newName = $request->input('name');
            $oldName = $request->input('oldName');
            if ($oldName) {
                $people = People::where('name', $oldName)->first();
                $message = 'Country is update successfully!';
            } else {
                $people = new People();
                $message = 'New country is create successfully!';
            }

            $people->name = $request->input('name');
            $people->profession = $request->input('profession');

            $people->save();
            return redirect()->route('admin.peopleList')->with('success', $message);
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->route('admin.peopleList')->with('error', $e->getMessage());
        }
    }

    public function getAllPeopleName()
    {
        $people = People::all();
        return $people;
    }

    public function getPeopleList()
    {
        $people = $this->getAllPeopleName();
        return view('adminPage/peopleList', ['people' => $people]);
    }

    public function findDirectorWithName($name)
    {
        $person = People::where('name', $name)
            ->where('profession', 'DIRECTOR')
            ->first();


        return $person->id_person;
    }
}
