<?php

require 'routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('email', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('main_page', 'DefaultController');
Router::get('discounts', 'DefaultController');
Router::get('rent_vehicle', 'DefaultController');
Router::get('registration', 'DefaultController');
Router::get('settings', 'DefaultController');

Router::run($path);