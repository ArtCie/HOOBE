<?php
session_start();
require_once 'MapController.php';
require_once 'src/models/ScootersRepository.php';
require_once 'src/repository/FilterRepository.php';

class MapController extends AppController
{
    private $FilterRepository;

    public function __construct()
    {
        $this->FilterRepository = new FilterRepository();
        parent::__construct();

    }

    public function main_page()
    {
        if(!$_SESSION){
            $this->render('email');
        }
        else if($this->isPost()){
            $this->logout();
        }
        else if($this->isPut()){
            $data = json_decode(file_get_contents('php://input'), true);
            $this->update_filters($data);
        }
        else if (isset($_GET['filters'])){
            echo json_encode($this->get_user_filters());
        }
        else if (isset($_GET['latitude'])) {
            $user_filters = $this->get_user_filters();
            $scooters_repository = new ScootersRepository((float) $_GET['latitude'], (float) $_GET['longitude']);
            $scooters = $scooters_repository->get_all_vehicles($user_filters);
            echo json_encode($scooters);
        }
        else {
            $this->render('main_page');
        }
    }

    public function get_user_filters(){
        if(empty($_SESSION["user_id"])){
            return $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];
            return $this->FilterRepository->getFilters($user_id);
        }
    }

    public function update_filters($data)
    {
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];
            $this->FilterRepository->updateFilters($user_id, $data);
        }
    }

    public function logout(){
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else{
        session_destroy();
        $this->render('email');
    }
    }
}
