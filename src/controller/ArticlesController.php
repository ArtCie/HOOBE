<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../repository/ArticlesRepository.php';

class ArticlesController extends AppController
{

    private $articleRepository;

    public function __construct()
    {
        parent::__construct();

        $this->articleRepository = new ArticlesRepository();
    }

    public function discounts()
    {
        if (empty($_SESSION["user_id"])) {
            $this->redirect("email");
        } else {
            $articlesData = $this->articleRepository->selectRecentArticles();
            $articles = $this->createArrayFromResult($articlesData);

            $this->render('discounts', [
                'articles' => $articles
            ]);
        }
    }

    public function createArrayFromResult($articlesData): array
    {
        $data = [];
        foreach ($articlesData as $index => $article) {
            $data[$index] = new Article(
                $article["headers"],
                $article["content"],
                $article["insert_timestamp"],
                $article["id"],
                $article["jpg_path"],
                $article["likes_count"],
                $article["comments_count"]
            );
            $data[$index]->updateContent();

        }
        return $data;
    }

    public function article()
    {
        if (empty($_SESSION["user_id"])) {
            $this->redirect("email");
        } else {
            $articleId = $_GET["article_id"];
            $articleData = $this->articleRepository->selectArticle($articleId);
            $article = $this->getArticle($articleData, $articleId);

            $commentsData = $this->articleRepository->selectComments($articleId);
            $comments = $this->getComments($commentsData);

            $isLike = $this->articleRepository->isLikeFromUser($_SESSION["user_id"], $articleId);

            $this->render('article', [
                'article' => $article,
                'comments' => $comments,
                'isLike' => $isLike
            ]);
        }
    }

    public function getArticle($articleData, $articleId): Article
    {
        return new Article(
            $articleData["headers"],
            $articleData["content"],
            $articleData["insert_timestamp"],
            $articleId,
            $articleData["jpg_path"]
        );
    }

    private function getComments($commentsData): array
    {
        $data = [];
        foreach ($commentsData as $index => $comment) {
            $data[$index] = new Comment(
                $comment["content"],
                $comment["insert_timestamp"],
                $comment["email"]
            );
        }
        return $data;
    }

    public function update_like()
    {
        if (empty($_SESSION["user_id"])) {
            $this->redirect("email");
        } else {
            $data = json_decode(file_get_contents('php://input'), true);
            $userId = $_SESSION["user_id"];
            if ($data["state"] === true) {
                $this->articleRepository->insertLike($userId, $data["articleId"]);
            } else {
                $this->articleRepository->deleteLike($userId, $data["articleId"]);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function publish_comment()
    {
        if (empty($_SESSION["user_id"])) {
            $this->redirect("email");
        } else {
            $data = json_decode(file_get_contents('php://input'), true);
            $articleId = $data["articleId"];
            $comment = $data["comment"];
            $userId = $_SESSION["user_id"];

            $commentId = $this->articleRepository->insertComment($userId, $articleId, $comment);
            $result = $this->articleRepository->getCommentData($commentId);
            $date = new DateTime($result["insert_timestamp"]);
            $data = [
                "email" => $result["email"],
                "comment" => $comment,
                "insert_timestamp" => $date->format('d/M/Y h:i:s')
            ];
            echo json_encode($data);
        }
    }

}