<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/CommentsUsers.php';


class AdminRepository extends Repository
{
    public function selectUsers()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT email, id from users;
        ');
        $stmt->execute();

        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        $users = array();
        foreach($result as $user){
            $comments = $this->selectComments($user["id"]);
            array_push($users, new CommentsUsers($user["email"], $comments));
        }
        return $users;
    }

    public function selectComments(string $userId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id, content from comments where user_id =:userId;
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchall(PDO::FETCH_ASSOC);

    }

    public function removeUser($userId){

        $stmt = $this->database->connect()->prepare('
            delete from user_preferences where user_id = :user_id;
        ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();


        $stmt = $this->database->connect()->prepare('
            delete from users where id = :id;
        ');
        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addArticle(string $header, string $content, $email){
        $stmt = $this->database->connect()->prepare('
            
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function validAdminPrivileges($data)
    {
        $stmt = $this->database->connect()->prepare('
            select 
                   1 as val
            from 
                 users u
            inner join
                account_types at
            on 
                at.id = u.account_type
            where
                u.id = :user_id
            and 
                at.id = 2
        ');
        $stmt->bindParam(':user_id', $data["userId"], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["val"];
    }

    public function selectUserIdbyEmail($email)
    {

        $stmt = $this->database->connect()->prepare('
        SELECT id as user_id FROM public.users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["user_id"];

    }

    public function deleteComment($commentId)
    {
        $stmt = $this->database->connect()->prepare('
            delete from
                comments
            where
                id = :id
        ');
        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);
        $stmt->execute();
    }
}