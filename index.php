<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');

Router::get('', 'DashboardController');
Router::get('movies', 'MoviesController');
Router::get('login', 'DashboardController');


Router::run($path);