<?php

require_once 'AppController.php';

class DashboardController extends AppController {

    public function index() {
        session_start();
        if (isset($_SESSION['logged'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/movies");
        }
            $this->render('login');
        }
}