<?php

require_once 'AppController.php';

class DashboardController extends AppController {

    public function index() {
//        session_start();
//        if($_SESSION['logged']) {
//            header('Location: /movies');
//        }
//        $_SESSION['logged'] = false;
        return $this->render('login');
    }
}