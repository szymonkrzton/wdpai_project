<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');

Router::get('', 'DashboardController');
Router::get('movies', 'MovieController');
Router::post('login', 'SecurityController');
Router::post('addMovie', 'MovieController');
Router::post('register', 'SecurityController');
Router::post('account', 'SecurityController');



Router::run($path);