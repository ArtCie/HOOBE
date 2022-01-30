<?php

require 'routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('email', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('main_page', 'MapController');
Router::get('discounts', 'ArticlesController');
Router::post('update_vehicle', 'SettingsController');
Router::get('rent_vehicle', 'DefaultController');
Router::get('registration', 'RegistrationController');
Router::post('settings', 'SettingsController');
Router::post('login', 'LoginController');
Router::post('email', 'EmailValidController');
Router::get('get_settings', 'SettingsController');
Router::post('update_settings', 'SettingsController');
Router::post('save_vehicle', 'RentalController');
Router::get('article', 'ArticlesController');
Router::put('update_like', 'ArticlesController');
Router::get('check_like', 'ArticlesController');
Router::post('publish_comment', 'ArticlesController');
Router::post('publish_comment', 'ArticlesController');
Router::post('remove_vehicle', 'SettingsController');

Router::run($path);