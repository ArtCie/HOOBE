<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ .'/../models/ValidUser.php';
require_once __DIR__ .'/../repository/AdminRepository.php';

class AdminController extends AppController {

    private $admin_repository;

    public function __construct()
    {
        parent::__construct();
        $this->admin_repository = new AdminRepository();
    }

    public function admin(): void
    {
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];

            if ($this->validAdminPrivileges($user_id) == 1) {
                $userComments = $this->admin_repository->selectUsers();
                $this->render('admin', ['userComments' => $userComments]);
            } else {
                $this->redirect('main_page');
            }
        }
    }

    public function remove_user(): void
    {
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];

            if ($this->validAdminPrivileges($user_id) == 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $email = $data["email"];

                $userId = $this->admin_repository->selectUserIdbyEmail($email);
                $this->admin_repository->removeUser($userId);
            }
        }
    }

    private function validAdminPrivileges($userId){
        $data = ["userId"=>$userId];
        return $this->admin_repository->validAdminPrivileges($data);
    }

    public function remove_comment(): void{
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];

            if ($this->validAdminPrivileges($user_id) == 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $commentId = $data["commentId"];

                $this->admin_repository->deleteComment($commentId);
            }
        }
    }

    public function add_article(): void{
        if(empty($_SESSION["user_id"])){
            $this->redirect("email");
        }
        else {
            $user_id = $_SESSION['user_id'];

            if ($this->validAdminPrivileges($user_id) == 1) {
                $data = json_decode(file_get_contents('php://input'), true);
                $data = [
                    "header" => $data["header"],
                    "content" => $data["content"],
                    "user_id" => $user_id,
                    "insert_timestamp" => gmdate("Y-m-d H:i:s"),
                    "jpg_path" => "article/" . rand(1, 6)
                ];
                var_dump($data);
                $this->admin_repository->addArticle($data);
            }
        }
    }

}