<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;

class LoginController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Log-in",
            "menuTitle" => "Menu",
            "content" => "login",
            "contentTitle" => "",
            "btn" => [
                [
                    "name" => "Home",
                    "link" => "/",
                    "color" => "yellowBtn"
                    // "hidden" => false
                ],
                [
                    "name" => "Sign-Up",
                    "link" => "/signup",
                    "color" => "blueBtn"
                    // "hidden" => false
                ]
            ]
        ],

        "fields" => [
            'pseudo' => "",
            'password'  => ""
        ],

        "status" => [
            'pseudo' => "",
            'password'  => ""
        ]
    ];

    //* ------------------------------------------------------------
    //* Get request

    public function index() {

        //* If already logged-in redirect to coordinates page
        $session = Services::session();
        if ($session->has('userinfo')) {
            return $this->response->redirect('/coordinates');
        }

        return view('common', $this->data);

    }

    //* ------------------------------------------------------------
    //* Post request

    public function form() {

        //* Check fields restrictions
        $input = $this->validate([
            'pseudo' => 'required|alpha_dash|min_length[4]|max_length[20]',
            'password' => 'required|min_length[6]|max_length[20]',
        ]);

        //* Get post fields
        $this->data["fields"]["pseudo"] = $this->request->getVar('pseudo');
        $this->data["fields"]["password"] = $this->request->getVar('password');

        //* Put fields status
        $validation = Services::validation();
        $this->data["status"]["pseudo"] = $validation->getError('pseudo');
        $this->data["status"]["password"] = $validation->getError('password');

        if ($input) {
            //* Validation success

            $userModel = new UserModel();
            $users = $userModel->readByPseudo($this->request->getVar('pseudo'));

            if ($users) {
                //* User has been found

                if (password_verify($this->request->getVar('password'), $users['password'])) {
                    //* Authentication success

                    unset($users["password"]);  //* Remove password value from user info
                    $session = Services::session();
                    $session->set('userinfo', $users);  //* Add user info to session

                    return $this->response->redirect('/coordinates');  //* Redirect to coordinates page

                } else {
                    //! Password error

                    $this->data["status"]["password"] = "Incorrect password";

                }

            } else {
                //! User has NOT been found

                $this->data["status"]["pseudo"] = "This pseudo hasn't been found";

            }

        }  //! Else validation error

        return view('common', $this->data);

    }
}
