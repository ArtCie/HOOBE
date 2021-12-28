<?php

require 'AppController.php';

class DefaultController extends AppController
{
    public function login(){
        $this->render('login');
    }

    public function registration(){
        $this->render('registration');
    }

    public function email(){
        $this->render('email');
    }

    public function main_page(){
        $this->render('main_page');
    }

    public function discounts(){
        $this->render('discounts');
    }

    public function rent_vehicle(){
        $this->render('rent_vehicle');
    }

    public function settings(){
        $this->render('settings');
    }
}