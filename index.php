<?php
error_reporting(E_ERROR | E_PARSE);
require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');

Router::get('', 'DashboardController');
Router::get('movies', 'MovieController');
Router::post('login', 'SecurityController');
Router::post('addMovie', 'MovieController');
Router::post('register', 'SecurityController');
Router::post('account', 'SecurityController');
Router::post('logout', 'SecurityController');
//Router::get('like', 'MovieController');
//Router::get('dislike', 'MovieController');
Router::post('search', 'MovieController');
Router::get('movie', 'MovieController');
Router::post('rating', 'MovieController');



Router::run($path);