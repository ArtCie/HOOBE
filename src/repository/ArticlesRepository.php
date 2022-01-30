<?php

require_once 'Repository.php';

class ArticlesRepository extends Repository
{

    public function selectRecentArticles()
    {
        $stmt = $this->database->connect()->prepare('
            select 
	            art.id, 
	            art.headers, 
	            art.content,
	            (select count(*) from likes l where l.article_id = art.id) as likes_count,
	            (select count(*) from comments c where c.article_id = art.id) as comments_count,
	            art.insert_timestamp
                from 
                    (select * from articles) art
                order by 
                    insert_timestamp 
                desc 
                    limit 5;
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectArticle($articleId){
        $stmt = $this->database->connect()->prepare('
            select
                headers,
                content,
                insert_timestamp,
                jpg_path
            from
                articles
            where
                id = :id
        ');

        $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isLikeFromUser($userId, $articleId){
        $stmt = $this->database->connect()->prepare('
            select
                true as "isLike"
            from
                likes
            where
                user_id = :user_id
            and 
                article_id = :article_id
        ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["isLike"];
    }

    public function insertLike($userId, $articleId){
        $stmt = $this->database->connect()->prepare('
            insert into
                likes
            (user_id, article_id)
            values
            (:user_id, :article_id)
        ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteLike($userId, $articleId){
        $stmt = $this->database->connect()->prepare('
            delete from
                likes
            where
                user_id = :user_id
            and 
                article_id = :article_id
            ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function selectComments($articleId)
    {
        $stmt = $this->database->connect()->prepare('
            select 
                c.content,
                c.insert_timestamp,
                u.email
            from
                comments c 
            inner join
                users u 
            on 
                c.user_id = u.id
            where
                c.article_id = :article_id
            order by
                c.insert_timestamp
            desc
            ');
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertComment($userId, $articleId, $comment)
    {
        $stmt = $this->database->connect()->prepare('
            insert into
                comments
            (user_id, article_id, content)
                values
            (:userId, :articleId, :comment)
            returning
                id;
            ');
        $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getCommentData($commentId)
    {
        $stmt = $this->database->connect()->prepare('
            select 
                   c.insert_timestamp, 
                   u.email 
            from 
                "comments" c 
            inner join 
                users u 
            on 
                c.user_id = u.id 
            where 
                c.id = :id;
            ');
        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}