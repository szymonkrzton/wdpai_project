<?php

require_once 'AppController.php';

class DashboardController extends AppController {

    public function index() {
        return $this->render('login');
    }

    public function movies() {
        return $this->render('movies');
    }
}