<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function index() {
        return view("index");
    }

    public function objects() {
        return view("objects");
    }

    public function addLocation(Request $request) {
        $objectData = json_decode($request->getContent());
        $city = $objectData->place->address_components[3]->long_name;
        $cityModel = new City();
        $cityObject = $cityModel->where("name", $city)->first();
        if(!$cityObject->count()) {
            $cityModel->name = $city;
            $cityModel->save();
            $cityId = $cityModel->id;
        }
        else {
            $cityId = $cityObject->id;
        }
        $locationModel = new Location();
        $locationModel->placeId = $objectData->placeId;
        $locationModel->name = $objectData->place->name;
        $locationModel->address = $objectData->place->formatted_address;
        $locationModel->cityId = $cityId;
        $locationModel->save();
    }

    function removeLocation(Request $request) {
        $placeId = json_decode($request->getContent())->placeId;
        $locationModel = new Location();
        $locationModel->where("placeId", $placeId)->delete();
        return response()->json(json_decode("{\"result\":\"success\"}"));
    }

    public function getLocations() {
        $locationModel = new Location();
        $locations = $locationModel::all();

        return response()->json($locations);
    }
}
