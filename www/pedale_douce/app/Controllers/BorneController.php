<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Libraries\ProcessClass;
use App\Libraries\MapClass;
// use App\Models\UserModel;

class BorneController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Borne",
            "menuTitle" => "Menu",
            "content" => "borne",
            "contentTitle" => "Select your station",
            "submitBtn" => "Return a bike",
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

        "mapFile" => "",

        "stations" => []
    ];

    //* ------------------------------------------------------------
    //* Get request

    public function index() {

        $session = Services::session();
        //! If NOT logged in-redirect to login page
        if (!$session->has('userinfo')) {
            return $this->response->redirect('/login');
        }

        $userinfo = $session->get("userinfo");
        $this->data["viewCfg"]["menuTitle"] = "Welcome " . $userinfo['pseudo'];

        $this->data["stations"] = ProcessClass::getAvailableBorneStation();
        $this->data["mapFile"] = MapClass::generate($this->data["stations"]);
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
            'station' => 'required'
        ]);

        //* Get post fields
        $selected = $this->request->getVar('station');
        for ($i = 0 ; $i < count($this->data["stations"]) ; $i++) {
            $this->data["stations"][$i]["selected"] = $i == $selected ? true : false;
        }
        // $this->data["fields"]["station"] = $this->request->getVar('station');
        // $this->data["fields"]["position_y"] = $this->request->getVar('position_y');

        //* Put fields status
        // $validation = Services::validation();
        // $this->data["status"]["position_x"] = str_replace("_", " ", $validation->getError('position_x'));
        // $this->data["status"]["position_y"] = str_replace("_", " ", $validation->getError('position_y'));

        if ($input) {
            //* Validation success

            // $this->data["viewCfg"]["contentTitle"] = "Success";
            // $this->data["viewCfg"]["contentTitle"] = $this->data["stations"][$this->request->getVar('station')]["uid"];
            // $this->data["viewCfg"]["contentTitle"] = $this->data["stations"][$this->request->getVar('station')]["name"];
            // $this->data["viewCfg"]["contentTitle"] = $this->request->getVar('station');
            // $userModel = new UserModel();
            // $users = $userModel->readByPseudo($this->request->getVar('pseudo'));
    
            // unset($users["password"]);  //* Remove password value from user info

            // $session = Services::session();
            // $session->set('userinfo', $users);  //* Add user info to session

            return $this->response->redirect('/confirmation');  //* Redirect to confirmation page

        }  //! Else validation error

        return view('common', $this->data);

    }
}
