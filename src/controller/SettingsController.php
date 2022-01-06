<?php
session_start();
require_once('src/models/Settings.php');
require_once('src/repository/SettingsRepository.php');

class SettingsController extends AppController
{
    private $settings_repository;

    public function __construct(){
        parent::__construct();
        $this->settings_repository = new SettingsRepository();
    }

    public function get_settings(){
        $user_id = intval($_SESSION["user_id"]);

        $settings = $this->settings_repository->getSettings($user_id);

        http_response_code(200);
        echo json_encode([
            "email"=> $settings->getEmail(),
            "birthday" => $settings->getBirthday()
        ]);
    }

    public function update_settings(){
        $user_id = $_SESSION["user_id"];
        $data = $_POST;
        $this->settings_repository->updateSettings($user_id, $data);

        $this->redirect('main_page');
    }
}