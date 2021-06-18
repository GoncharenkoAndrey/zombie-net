<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\Location;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $latitude = $request->get("latitude");
        $longitude = $request->get("longitude");
        $locationModel = new Location();
        $locationModel->latitude = $latitude;
        $locationModel->longitude = $longitude;
        $locationModel->save();
    }

    public function getLocations() {

    }
}
