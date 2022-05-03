<?php

require_once 'AppController.php';

class DashboardController extends AppController {

    public function dashboard() {
        // TODO return and render display.html
        $hello = 'Welcome on Dahboard page!';
        return $this->render('dashboard', ['greetings' => $hello]);
    }

    public function index() {
        $hi = 'Welcome on Main page!';
        return $this->render('index', ['greetings' => $hi]);
    }

    public function login() {
        return $this->render('login');
    }
}