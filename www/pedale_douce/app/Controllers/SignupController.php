<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;

class SignupController extends Controller {

    protected $data = [
        "viewCfg" => [
            "title" => "Sign-up",
            "menuTitle" => "Menu",
            "content" => "signup",
            "contentTitle" => "Create Account",
            "btn" => [
                [
                    "name" => "Home",
                    "link" => "/",
                    "color" => "yellowBtn"
                    // "hidden" => false
                ],
                [
                    "name" => "Log-In",
                    "link" => "/login",
                    "color" => "greenBtn"
                    // "hidden" => false
                ]
            ]
        ],

        "fields" => [
            'pseudo' => "",
            'email' => "",
            'email_confirmation' => "",
            'password' => "",
            'password_confirmation'  => ""
        ],

        "status" => [
            'pseudo' => "",
            'email' => "",
            'email_confirmation' => "",
            'password' => "",
            'password_confirmation'  => ""
        ]
    ];

    //* ------------------------------------------------------------
    //* Get request

    public function index() {

        return view('common', $this->data);

    }

    //* ------------------------------------------------------------
    //* Post request

    public function form() {

        //* Check fields restrictions
        $input = $this->validate([
            'pseudo' => 'required|alpha_dash|min_length[4]|max_length[20]',
            'email' => 'required|valid_email|max_length[40]',
            'email_confirmation' => 'required|valid_email|max_length[40]',
            'password' => 'required|min_length[6]|max_length[20]',
            'password_confirmation' => 'required|min_length[6]|max_length[20]'
        ]);

        //* Get post fields
        $this->data["fields"]["pseudo"] = $this->request->getVar('pseudo');
        $this->data["fields"]["email"] = $this->request->getVar('email');
        $this->data["fields"]["email_confirmation"] = $this->request->getVar('email_confirmation');
        $this->data["fields"]["password"] = $this->request->getVar('password');
        $this->data["fields"]["password_confirmation"] = $this->request->getVar('password_confirmation');

        //* Put fields status
        $validation = Services::validation();
        $this->data["status"]["pseudo"] = $validation->getError('pseudo');
        $this->data["status"]["email"] = $validation->getError('email');
        $this->data["status"]["email_confirmation"] = str_replace("_", " ", $validation->getError('email_confirmation'));
        $this->data["status"]["password"] = $validation->getError('password');
        $this->data["status"]["password_confirmation"] = str_replace("_", " ", $validation->getError('password_confirmation'));

        if ($input) {
            //* Validation success

            $userModel = new UserModel();
            $newUser = [];  //* New user data
            $newUser["pseudo"] = $this->request->getVar('pseudo');
            $users = $userModel->readByPseudo($newUser["pseudo"]);
    
            if (!$users) {
                //* User pseudo is available

                $newUser["email"] = $this->request->getVar('email');
                $confirmEmail = $this->request->getVar('email_confirmation');

                if ($newUser["email"] === $confirmEmail) {
                    //* Email fields match

                    $newUser["password"] = $this->request->getVar('password');
                    $confirmPassword = $this->request->getVar('password_confirmation');

                    if ($newUser["password"] === $confirmPassword) {
                        //* Password fields match (All success)

                        $newUser["password"] = password_hash($newUser["password"], PASSWORD_DEFAULT);
                        $newUser["role"] = 1;
                        $tst = $userModel->create($newUser);

                        return $this->response->redirect('/login');

                    } else {
                        //! Password fields NOT match

                        $this->data["status"]["password_confirmation"] = "Password fields NOT match";
                    }

                } else {
                    //! Email fields NOT match

                    $this->data["status"]["email_confirmation"] = "Email fields NOT match";

                }

            } else {
                //! User pseudo is NOT available

                $this->data["status"]["pseudo"] = "Sorry, this pseudo is already in use";

            }

        }  //! Else validation error

        return view('common', $this->data);

    }
}
