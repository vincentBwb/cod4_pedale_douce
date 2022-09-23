<?php

namespace App\Controllers;

class HomeController extends BaseController {

    protected $data = [
        "viewCfg" => [
            "title" => "Home",
            "menuTitle" => "Menu",
            "content" => "home",
            "btn" => [
                [
                    "name" => "Sign-Up",
                    "link" => "/signup",
                    "color" => "blueBtn"
                    // "hidden" => false
                ],
                [
                    "name" => "Log-In",
                    "link" => "/login",
                    "color" => "greenBtn"
                    // "hidden" => false
                ]
            ]
        ]
    ];

    //* ------------------------------------------------------------
    //* Get request

    public function index() {

        return view('common', $this->data);

    }

}
