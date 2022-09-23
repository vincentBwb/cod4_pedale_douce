<?php

namespace App\Libraries;

use Config\Services;
use App\Models\UserModel;
use App\Models\StationModel;
use App\Models\BorneModel;
use App\Models\BikeModel;

class ProcessClass
{

    public static function getAvailableBikeStation()
    {

        $session = Services::session();
        $userinfo = $session->get("userinfo");
        $ux = $userinfo["coor_x"];
        $uy = $userinfo["coor_y"];

        $stationModel = new StationModel;
        $borneModel = new BorneModel;
        $bikeModel = new BikeModel;

        $stations = $stationModel->readAllRec();
        //* Array to associative array by uid
        foreach ($stations as $station) {
            $idx = $station["uid"];
            $tmp[$idx] = $station;
            $tmp[$idx]["stat"] = 2;
            $tmp[$idx]["selected"] = false;
            $tmp[$idx]["count"] = 0;
            $tmp[$idx]["bikesUid"] = [];
        }

        $availableBikes = $bikeModel->readAllByStatus(1);
        for ($i = 0; $i < count($availableBikes); $i++) {
            $borneUid = $availableBikes[$i]["fk_borne"];
            $borne = $borneModel->readOneByUid($borneUid);

            $stationUid = $borne["fk_station"];
            $availableBikes[$i]["stationUid"] = $stationUid;

            $tmp[$stationUid]["stat"] = 1;
            $tmp[$stationUid]["count"] += 1;

            $bikeUid = $availableBikes[$i]["uid"];
            array_push($tmp[$stationUid]["bikesUid"], $bikeUid);
        }

        $dRef = 1222;
        $nearestUid = 0;
        //* Array to associative array by uid
        foreach ($tmp as $station) {
            $idx = $station["uid"];
            $sx = $station["coor_x"];
            $sy = $station["coor_y"];
            $d = sqrt(pow($sx - $ux, 2) + pow($sy - $uy, 2));
            $tmp[$idx]["distance"] = round($d, 2);
            if ($d < $dRef) {
                $dRef = $d;
                $nearestUid = $idx;
            }
        }

        $tmp[$nearestUid]["stat"] = 0;
        $tmp[$nearestUid]["selected"] = true;

        //* Associative array to indexed array
        $sttns = [];
        foreach ($tmp as $station) {
            array_push($sttns, $station);
        }

        return $sttns;  //* Return formated stations list
    }

    //* ------------------------------------------------------------

    public static function getAvailableBorneStation()
    {

        $session = Services::session();
        $userinfo = $session->get("userinfo");
        $ux = $userinfo["coor_x"];
        $uy = $userinfo["coor_y"];

        $stationModel = new StationModel;
        $borneModel = new BorneModel;

        $stations = $stationModel->readAllRec();
        //* Array to associative array by uid
        foreach ($stations as $station) {
            $idx = $station["uid"];
            $tmp[$idx] = $station;
            $tmp[$idx]["stat"] = 2;
            $tmp[$idx]["selected"] = false;
            $tmp[$idx]["count"] = 0;
            $tmp[$idx]["bornesUid"] = [];
        }

        $availableBornes = $borneModel->readAllByStatus(0);
        for ($i = 0; $i < count($availableBornes); $i++) {
            $stationUid = $availableBornes[$i]["fk_station"];

            $tmp[$stationUid]["stat"] = 1;
            $tmp[$stationUid]["count"] += 1;

            $borneUid = $availableBornes[$i]["uid"];
            array_push($tmp[$stationUid]["bornesUid"], $borneUid);
        }

        $dRef = 1222;
        $nearestUid = 0;
        //* Array to associative array by uid
        foreach ($tmp as $station) {
            $idx = $station["uid"];
            $sx = $station["coor_x"];
            $sy = $station["coor_y"];
            $d = sqrt(pow($sx - $ux, 2) + pow($sy - $uy, 2));
            $tmp[$idx]["distance"] = round($d, 2);
            if ($d < $dRef) {
                $dRef = $d;
                $nearestUid = $idx;
            }
        }

        $tmp[$nearestUid]["stat"] = 0;
        $tmp[$nearestUid]["selected"] = true;

        //* Associative array to indexed array
        $sttns = [];
        foreach ($tmp as $station) {
            array_push($sttns, $station);
        }

        return $sttns;  //* Return formated stations list
    }
}
