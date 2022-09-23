<?php

namespace App\Controllers;

use Config\Services;

class ConfirmationController extends BaseController {

    protected $data = [
        "viewCfg" => [
            "title" => "Confirmation",
            "menuTitle" => "Menu",
            "content" => "confirmation",
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
        //! If user has NOT blue card redirect to bluecard page
        if (!$userinfo["fk_cb"]) {
            return $this->response->redirect('/bluecard');
        }

        $this->data["viewCfg"]["menuTitle"] = "Welcome " . $userinfo['pseudo'];

        return view('common', $this->data);

    }

}
