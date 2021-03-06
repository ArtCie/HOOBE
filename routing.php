<?php

    require_once('src/controller/DefaultController.php');
    require_once 'src/controller/LoginController.php';
    require_once 'src/controller/EmailValidController.php';
    require_once 'src/controller/RegistrationController.php';
    require_once 'src/controller/MapController.php';
    require_once 'src/controller/SettingsController.php';
    require_once 'src/controller/RentalController.php';
    require_once 'src/controller/ArticlesController.php';
    require_once 'src/controller/AdminController.php';

    class Router {

        public static $routes;

        public static function get($url, $view){
            self::$routes[$url] = $view;
        }

        public static function post($url, $view) {
            self::$routes[$url] = $view;
        }

        public static function put($url, $view){
            self::$routes[$url] = $view;
        }

        public static function run ($url){

            $action = explode("/", $url)[0];
            if(!array_key_exists($action, self::$routes)) {
                die("Wrong url!");
            }

            $controller = self::$routes[$action];
            $object = new $controller;
            $action = $action ?: 'index';

            $object -> $action();
        }


    }