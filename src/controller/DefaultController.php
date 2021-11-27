<?php

require 'AppController.php';

class DefaultController extends AppController
{
    public function login(){
        $this->render('login');
    }

    public function email(){
        $adi = 'adi';
        $this->render('email');
    }

    public function main_page(){
        $this->render('main_page');
    }

    public function discounts(){
        $this->render('discounts');
    }
}