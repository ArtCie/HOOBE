<?php
session_start();
require_once 'MapController.php';
require_once 'src/models/ScootersRepository.php';
//require_once __DIR__ .'/../models/ValidUser.php';
//require_once __DIR__ .'/../repository/LoginRepository.php';

class MapController extends AppController
{

    public function __construct()
    {
        parent::__construct();

    }

    public function main_page()
    {
        if (isset($_GET['latitude'])) {
            $scooters_repository = new ScootersRepository((float) $_GET['latitude'], (float) $_GET['longitude']);
            $scooters = $scooters_repository->get_all_scooters();
            echo json_encode($scooters);
        }
        else {
            $this->render('main_page');
        }
    }

}
