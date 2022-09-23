<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;
use App\Models\BikeModel;
use App\Models\BorneModel;

class CoordinatesController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Reservation",
            "menuTitle" => "Menu",
            "content" => "coordinates",
            "contentTitle" => "User coordinates",
            "submitBtn" => "Validate",
            "btn" => [
                [
                    "name" => "Profile",
                    "link" => "/profile",
                    "color" => "blueBtn"
                    // "hidden" => false
                ],
                [
                    "name" => "Log-Out",
                    "link" => "/logout",
                    "color" => "redBtn"
                    // "hidden" => false
                ]
            ]
        ],

        "fields" => [
            'position_x' => "",
            'position_y'  => ""
        ],

        "status" => [
            'position_x' => "",
            'position_y'  => ""
        ]
    ];

    protected $adminBtn = [
        "name" => "Admin",
        "link" => "/admin",
        "color" => "orangeBtn"
    ];

    //* ------------------------------------------------------------
    //* Get request

    public function index() {

        $session = Services::session();
        //! If NOT logged-in redirect to login page
        if (!$session->has('userinfo')) {
            return $this->response->redirect('/login');
        }

        $userinfo = $session->get("userinfo");
        $this->data["viewCfg"]["menuTitle"] = "Welcome " . $userinfo['pseudo'];

        //* Add 'Admin' button if user is Admin
        $userinfo = $session->get("userinfo");
        if ($userinfo["role"] === "0") {
            array_splice($this->data["viewCfg"]["btn"], 0, 0, [$this->adminBtn]);
        }

        if (isset($userinfo["coor_x"])) {
            $this->data["fields"]["position_x"] = $userinfo["coor_x"];
        }

        if (isset($userinfo["coor_y"])) {
            $this->data["fields"]["position_y"] = $userinfo["coor_y"];
        }

        //* Cancel reservation choice if user has an reservation
        $fkBike = $userinfo["fk_bike"];
        $timeBike = $userinfo["time_bike"];
        $fkBorne = $userinfo["fk_borne"];
        $timeBorne = $userinfo["time_borne"];
        if (($fkBike && $timeBike) || ($fkBorne && $timeBorne)) {
            return $this->response->redirect('/cancelation');  //! Redirect to cancelation page
        }

        return view('common', $this->data);

    }

    //* ------------------------------------------------------------
    //* Post request

    public function form() {

        $session = Services::session();
        $userinfo = $session->get("userinfo");
        $this->data["viewCfg"]["menuTitle"] = "Welcome " . $userinfo['pseudo'];

        //* Check fields restrictions
        $input = $this->validate([
            'position_x' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[1000]',
            'position_y' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[700]'
        ]);

        //* Get post fields
        $this->data["fields"]["position_x"] = $this->request->getVar('position_x');
        $this->data["fields"]["position_y"] = $this->request->getVar('position_y');

        //* Put fields status
        $validation = Services::validation();
        $this->data["status"]["position_x"] = str_replace("_", " ", $validation->getError('position_x'));
        $this->data["status"]["position_y"] = str_replace("_", " ", $validation->getError('position_y'));

        if ($input) {
            //* Validation success

            $userinfo = $session->get("userinfo");  //* Get user info from session

            $userinfo["coor_x"] = $this->request->getVar('position_x');  //* Add user position x
            $userinfo["coor_y"] = $this->request->getVar('position_y');  //* Add user position y
            $session->set('userinfo', $userinfo);  //* Update user info to session

            $fkBike = $userinfo["fk_bike"];
            // $fkBike = 1;
            if ($fkBike) {

                return $this->response->redirect('/borne');  //* Redirect to born page

            }

            return $this->response->redirect('/bike');  //* Redirect to bike page
    
        }  //! Else validation error

        return view('common', $this->data);

    }
}
