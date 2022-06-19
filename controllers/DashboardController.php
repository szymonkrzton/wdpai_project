<?php

require_once 'AppController.php';

class DashboardController extends AppController {

    public function index() {
        session_start();
        if($_SESSION['logged']) {
            header('Location: /movies');
        }
        return $this->render('login');
    }

    public function movies() {
        session_start();
        if(!$_SESSION['logged']) {
            header('Location: /');
        }
        return $this->render('movies');
    }
}