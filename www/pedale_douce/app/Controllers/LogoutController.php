<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class LogoutController extends Controller {

    public function index() {

        $session = Services::session();
        $session->destroy();  //* Destroy session
        return $this->response->redirect('/login');  //* Redirect to login page

    }

}
