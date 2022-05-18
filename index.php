<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');

Router::get('', 'DashboardController');
Router::get('movies', 'DashboardController');
Router::post('login', 'SecurityController');
Router::post('addMovie', 'MovieController');



Router::run($path);