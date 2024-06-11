<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CountryRequest;
use App\Models\Country;

class CountriesController extends Controller
{

    public function deleteCountry($id)
    {

        try {

            $country = Country::find($id);

            $country->delete();
            
            return redirect()->route('admin.countryList')->with('success', 'Country is deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.countryList')->with('error', $e->getMessage());
        }
    }

    public function newCountry(CountryRequest $request)
    {
        try {
            $newName = $request->input('name');
            $oldName = $request->input('oldName');


            if ($oldName) {
                $country = Country::where('name', $oldName)->first();
                $message = 'Country is update successfully!';
            } else {
                $country = new Country();
                $message = 'New country is create successfully!';
            }

            $country->name = $newName;
            $country->save();
            return redirect()->route('admin.countryList')->with('success', $message);
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->route('admin.countryList')->with('error', $e->getMessage());
        }
    }

    public function getAllCountryNames()
    {
        $countries = Country::all();

        return $countries;
    }

    public function getCountryList()
    {
        $countries = $this->getAllCountryNames();

        return view('adminPage/countryList', ['countries' => $countries]);
    }



    public function getCountry($name)
    {
        $country = Country::where('name', $name)
            ->first();


        if (!$country) {
            $country = new Country();
            $country->name = $name;

            if (!$country->save()) {
                throw new \Exception('Failed to save new person.');
            }
        }

        return $country->id_country;
    }
}
