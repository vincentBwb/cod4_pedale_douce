<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;

class ProfileController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Profile",
            "menuTitle" => "Menu",
            "content" => "profile",
            "contentTitle" => "Edit profile",
            "btn" => [
                [
                    "name" => "Return",
                    "link" => "/coordinates",
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
            'email' => "",
            'email_confirmation' => "",
            'password' => "",
            'password_confirmation'  => ""
        ],

        "status" => [
            'email' => "",
            'email_confirmation' => "",
            'password' => "",
            'password_confirmation'  => ""
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

        $this->data["fields"]["email"] = $userinfo["email"];
        $this->data["fields"]["email_confirmation"] = $userinfo["email"];


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
            'email' => 'required|valid_email|max_length[40]',
            'email_confirmation' => 'required|valid_email|max_length[40]',
            'password' => 'permit_empty|min_length[6]|max_length[20]',
            'password_confirmation' => 'permit_empty|required_with[password]|min_length[6]|max_length[20]'
        ]);

        //* Get post fields
        $this->data["fields"]["email"] = $this->request->getVar('email');
        $this->data["fields"]["email_confirmation"] = $this->request->getVar('email_confirmation');
        $this->data["fields"]["password"] = $this->request->getVar('password');
        $this->data["fields"]["password_confirmation"] = $this->request->getVar('password_confirmation');

        //* Put fields status
        $validation = Services::validation();
        $this->data["status"]["email"] = $validation->getError('email');
        $this->data["status"]["email_confirmation"] = str_replace("_", " ", $validation->getError('email_confirmation'));
        $this->data["status"]["password"] = $validation->getError('password');
        $this->data["status"]["password_confirmation"] = str_replace("_", " ", $validation->getError('password_confirmation'));

        if ($input) {
            //* Validation success

            $newEmail = $this->request->getVar('email');
            $newConfirmEmail = $this->request->getVar('email_confirmation');

            if ($newEmail === $newConfirmEmail) {
                //* Email fields match

                $newPassword = $this->request->getVar('password');
                $newConfirmPassword = $this->request->getVar('password_confirmation');

                if ($newPassword === $newConfirmPassword) {
                    //* Password fields match (All success)

                    $user = [];  //* User news data
                    $userinfo = $session->get("userinfo");
                    $needUpdate = false;

                    if ($userinfo["email"] !== $newEmail) {

                        $user["email"] = $newEmail;
                        $this->data["status"]["email_confirmation"] = "Email has been updated";
                        $needUpdate = true;

                    }

                    if ($newPassword) {

                        $user["password"] = password_hash($newPassword, PASSWORD_DEFAULT);
                        $this->data["status"]["password_confirmation"] = "Password has been updated";
                        $needUpdate = true;

                    }

                    if ($needUpdate) {

                        $userModel = new UserModel();
                        $check = $userModel->updateByUid($userinfo["uid"], $user);  //* Update database
                        //* '$check' is a boolean: 'TRUE' if database has been successfuly updated

                        //* Reload user info
                        $newData = $userModel->readOneByUid($userinfo["uid"]);
                        unset($newData["password"]);  //* Remove password value from user info
                        if (isset($userinfo["coor_x"])) {$newData["coor_x"] = $userinfo["coor_x"];}
                        if (isset($userinfo["coor_y"])) {$newData["coor_y"] = $userinfo["coor_y"];}
                        $session->set('userinfo', $newData);  //* Update user info to session
    
                        $this->data["viewCfg"]["contentTitle"] = "Your profile has been updated";

                    } else {

                        $this->data["status"]["email_confirmation"] = "Not data to update";
                        $this->data["status"]["password_confirmation"] = "Not data to update";

                    }

                } else {
                    //! Password fields NOT match

                    $this->data["status"]["password_confirmation"] = "Password fields NOT match";
                }

            } else {
                //! Email fields NOT match

                $this->data["status"]["email_confirmation"] = "Email fields NOT match";

            }

        }  //! Else validation error

        return view('common', $this->data);

    }
}
