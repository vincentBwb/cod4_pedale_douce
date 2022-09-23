<?php

namespace App\Controllers;

use Config\Services;

class CancelationController extends BaseController {

    protected $data = [
        "viewCfg" => [
            "title" => "Cancelation",
            "menuTitle" => "Menu",
            "content" => "cancelation",
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

        return view('common', $this->data);

    }

}
