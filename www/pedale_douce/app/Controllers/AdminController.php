<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StationModel;
use App\Models\BikeModel;
use App\Models\BorneModel;
use App\Models\BlueCardModel;

class AdminController extends BaseController
{

    public function index()
    {

        return view('admin/tables');
    }

    //* ################################################################################

    public function usersCreate()
    {

        $data = [];
        $data["table"] = "users";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function stationsCreate()
    {

        $data = [];
        $data["table"] = "stations";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bikesCreate()
    {

        $data = [];
        $data["table"] = "bikes";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bornesCreate()
    {

        $data = [];
        $data["table"] = "bornes";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bluecardsCreate()
    {

        $data = [];
        $data["table"] = "blue_cards";

        return view('admin/form', $data);
    }

    //* ################################################################################

    public function usersList()
    {

        $model = new UserModel();
        $records = $model->readAllRec();
        $data = [];
        $data["table"] = "users";
        $data["columns"] = ["uid", "pseudo", "password", "email", "cb", "role", "bike", "time", "borne", "time", "Edit", "Delete"];
        $data["records"] = $records;

        return view('admin/list', $data);
    }

    //* ------------------------------------------------------------

    public function stationsList()
    {

        $model = new StationModel();
        $records = $model->readAllRec();
        $data = [];
        $data["table"] = "stations";
        $data["columns"] = ["uid", "num", "name", "x", "y", "Edit", "Delete"];
        $data["records"] = $records;

        return view('admin/list', $data);
    }

    //* ------------------------------------------------------------

    public function bikesList()
    {

        $model = new BikeModel();
        $records = $model->readAllRec();
        $data = [];
        $data["table"] = "bikes";
        $data["columns"] = ["uid", "serial", "status", "borne", "Edit", "Delete"];
        $data["records"] = $records;

        return view('admin/list', $data);
    }

    //* ------------------------------------------------------------

    public function bornesList()
    {

        $model = new BorneModel();
        $records = $model->readAllRec();
        $data = [];
        $data["table"] = "bornes";
        $data["columns"] = ["uid", "num", "status", "code", "station", "Edit", "Delete"];
        $data["records"] = $records;

        return view('admin/list', $data);
    }

    //* ------------------------------------------------------------

    public function bluecardsList()
    {

        $model = new BlueCardModel();
        $records = $model->readAllRec();
        $data = [];
        $data["table"] = "blue_cards";
        $data["columns"] = ["uid", "first_name", "last_name", "number", "cryptogram", "expiry", "Edit", "Delete"];
        $data["records"] = $records;

        return view('admin/list', $data);
    }

    //* ################################################################################

    public function usersEdit($uid)
    {

        $data = [];
        $data["table"] = "users";
        $data["uid"] = $uid;

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function stationsEdit($uid)
    {

        $data = [];
        $data["table"] = "stations";
        $data["uid"] = $uid;

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bikesEdit($uid)
    {

        $data = [];
        $data["table"] = "bikes";
        $data["uid"] = $uid;

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bornesEdit($uid)
    {

        $data = [];
        $data["table"] = "bornes";
        $data["uid"] = $uid;

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bluecardsEdit($uid)
    {

        $data = [];
        $data["table"] = "blue_cards";
        $data["uid"] = $uid;

        return view('admin/form', $data);
    }

    //* ################################################################################

    public function usersSave()
    {

        $data = [];
        $data["table"] = "users";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function stationsSave()
    {

        $data = [];
        $data["table"] = "stations";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bikesSave()
    {

        $data = [];
        $data["table"] = "bikes";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bornesSave()
    {

        $data = [];
        $data["table"] = "bornes";

        return view('admin/form', $data);
    }

    //* ------------------------------------------------------------

    public function bluecardsSave()
    {

        $data = [];
        $data["table"] = "blue_cards";

        return view('admin/form', $data);
    }

    //* ################################################################################

    public function usersDel($uid)
    {

        $data = [];
        $data["table"] = "users";
        $data["uid"] = $uid;

        return view('admin/delete', $data);
    }

    //* ------------------------------------------------------------

    public function stationsDel($uid)
    {

        $data = [];
        $data["table"] = "stations";
        $data["uid"] = $uid;

        return view('admin/delete', $data);
    }

    //* ------------------------------------------------------------

    public function bikesDel($uid)
    {

        $data = [];
        $data["table"] = "bikes";
        $data["uid"] = $uid;

        return view('admin/delete', $data);
    }

    //* ------------------------------------------------------------

    public function bornesDel($uid)
    {

        $data = [];
        $data["table"] = "bornes";
        $data["uid"] = $uid;

        return view('admin/delete', $data);
    }

    //* ------------------------------------------------------------

    public function bluecardsDel($uid)
    {

        $data = [];
        $data["table"] = "blue_cards";
        $data["uid"] = $uid;

        return view('admin/delete', $data);
    }
}
