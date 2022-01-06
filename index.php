<?php

require 'routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('email', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('main_page', 'MapController');
Router::get('discounts', 'DefaultController');
Router::get('rent_vehicle', 'DefaultController');
Router::get('registration', 'RegistrationController');
Router::get('settings', 'DefaultController');
Router::post('login', 'LoginController');
Router::post('email', 'EmailValidController');
Router::get('get_settings', 'SettingsController');
Router::post('update_settings', 'SettingsController');
Router::post('save_vehicle', 'RentalController');

Router::run($path);