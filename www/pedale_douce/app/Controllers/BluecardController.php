<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;
use App\Models\BlueCardModel;

class BluecardController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Blue Card",
            "menuTitle" => "Menu",
            "content" => "blue_card",
            "contentTitle" => "Create blue card",
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
            'first_name' => "",
            'last_name' => "",
            'number' => "",
            'cryptogram' => "",
            'expiry'  => ""
        ],

        "status" => [
            'first_name' => "",
            'last_name' => "",
            'number' => "",
            'cryptogram' => "",
            'expiry'  => ""
        ]
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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'number' => 'required|regex_match[/[0-9]{16}/]|exact_length[16]',
            'cryptogram' => 'required|regex_match[/[0-9]{3}/]|exact_length[3]',
            'expiry' => 'required|valid_date[m/y]'
        ]);

        //* Get post fields
        $this->data["fields"]["first_name"] = $this->request->getVar('first_name');
        $this->data["fields"]["last_name"] = $this->request->getVar('last_name');
        $this->data["fields"]["number"] = $this->request->getVar('number');
        $this->data["fields"]["cryptogram"] = $this->request->getVar('cryptogram');
        $this->data["fields"]["expiry"] = $this->request->getVar('expiry');

        //* Put fields status
        $validation = Services::validation();
        $this->data["status"]["first_name"] = str_replace("_", " ", $validation->getError('first_name'));
        $this->data["status"]["last_name"] = str_replace("_", " ", $validation->getError('last_name'));
        $this->data["status"]["number"] = $validation->getError('number');
        $this->data["status"]["cryptogram"] = $validation->getError('cryptogram');
        $this->data["status"]["expiry"] = $validation->getError('expiry');

        if ($input) {
            //* Validation success

            //* Create blue card record
            $bluecardModel = new BlueCardModel();
            $cardUid = $bluecardModel->create($this->data["fields"]);  //* Update 'blue_cards' table
            
            //* Update user bluecard
            $userModel = new UserModel();
            $blueCard = ["fk_cb" => $cardUid];
            $check = $userModel->updateByUid($userinfo["uid"], $blueCard);  //* Update 'users' table
            //* '$check' is a boolean: 'TRUE' if database has been successfuly updated

            //* Reload user info
            $newData = $userModel->readOneByUid($userinfo["uid"]);
            unset($newData["password"]);  //* Remove password value from user info
            if (isset($userinfo["coor_x"])) {$newData["coor_x"] = $userinfo["coor_x"];}
            if (isset($userinfo["coor_y"])) {$newData["coor_y"] = $userinfo["coor_y"];}
            $session->set('userinfo', $newData);  //* Update user info to session

            return $this->response->redirect('/confirmation');  //* Redirect to confirmation page

        }  //! Else validation error

        return view('common', $this->data);

    }
}
