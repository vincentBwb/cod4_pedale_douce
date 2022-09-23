<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StationModel;
use App\Models\BorneModel;
use App\Models\BikeModel;
use App\Libraries\ProcessClass;
use App\Libraries\MapClass;
use Config\Services;

class TestController extends BaseController {

    public function test()
    {

        //* ################################################################################

        // $data["stations"] = ProcessClass::getAvailableBorneStation();

        //* ################################################################################

        // $data["stations"] = ProcessClass::getAvailableBikeStation();

        //* ################################################################################

        $stationModel = new StationModel;
        $borneModel = new BorneModel;
        $bikeModel = new BikeModel;
        
        $stations = $stationModel->readAllRec();
        for ($i = 0 ; $i < count($stations) ; $i++) {
            $bornes = $borneModel->readAllByFkStation($stations[$i]["uid"]);
            $stations[$i]["bornes"] = $bornes;
            for ($j = 0 ; $j < count($bornes) ; $j++) {
                $bike = $bikeModel->readOneByFkBorne($bornes[$j]["uid"]);
                $stations[$i]["bornes"][$j]["bike"] = $bike;
            }
        }

        $data["stations"] = $stations;

        //* ################################################################################

        // $data["stations"] = [];

        //* ################################################################################

        return view('test_display', $data);

        //* ################################################################################

    }

}
