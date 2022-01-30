<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/email.css">
    <link rel="stylesheet" type="text/css" href="public/css/main_page.css">
    <link rel="stylesheet" type="text/css" href="public/css/discounts.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Articles</title>
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="main">
    <nav>
        <ul>
            <li>
                <img alt="logo" src="public/img/logo.svg">
            </li>
            <li>
                <div class="dropdown">
                    <a href="#" class="dropbtn">
                        <i class="fas fa-filter "></i>
                        Filter
                        <span class="i material-icons">
                            expand_more
                      </span>
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Bolt</a>
                        <a href="#">Lime</a>
                        <a href="#">Tier</a>
                        <a href="#">Panek</a>
                        <a href="#">Private Vehicles</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropbtn">
                    <i class="fas fa-percent"></i>
                    Discounts
                </a>
            </li>
            <li>
                <a href="#" class="dropbtn">
                    <i class="fas fa-car"></i>
                    Rent your vehicle
                </a>
            </li>
        </ul>
    </nav>
    <div class="map-wrapper">
    </div>

    <div id="articles">
        <form id="first-box" class="fill" action="http://localhost:8080/article" method="GET">
        <input type="hidden" name="article_id" value=<?php if (isset($articles)) {
            echo $articles[0]->getIndex();
        }?>>
            <div class="height-fix">
                <img alt="logo" class="first-jpg" src="public/img/articles/pig.svg">
            </div>
            <div>
                <button>
                <div class="header">
                    <?php if (isset($articles)) {
                            echo $articles[0]->getHeader();
                    } ?>
                </div>
                <div class="description">
                    <?php if (isset($articles)) {
                        echo $articles[0]->getContent();
                    } ?>
                </div>
                <div class="details">
                <div class="like-and-comments">
                    <img alt="like" src="public/img/articles/like.svg">
                    <?php if (isset($articles)) {
                        echo $articles[0]->getLikes();
                    } ?>
                </div>
                <div class="like-and-comments">
                    <img alt="comment" src="public/img/articles/comment.svg">
                    <?php if (isset($articles)) {
                        echo $articles[0]->getComments();
                    } ?>
                </div>
                </div>

            </button>
            </div>
        </form>

        <a href="#" id="second-box">
            <div id="text">
                <div class="header change-margin">
                    <?php if (isset($articles)) {
                        echo $articles[1]->getHeader();
                    } ?>
                </div>
                <div class="description">
                    <?php if (isset($articles)) {
                        echo $articles[1]->getContent();
                    } ?>
                </div>
                <div class="details">
                    <div class="like-and-comments">
                        <img alt="like" src="public/img/articles/like.svg">
                        <?php if (isset($articles)) {
                            echo $articles[1]->getLikes();
                        } ?>
                    </div>
                    <div class="like-and-comments">
                        <img alt="comment" src="public/img/articles/comment.svg">
                        <?php if (isset($articles)) {
                            echo $articles[1]->getComments();
                        } ?>
                    </div>
                </div>
            </div>

            <div class="width-fix">
                <img alt="logo" class="first-jpg" src="public/img/articles/lime.svg">
            </div>
        </a>

        <a href="#" class="other-boxes">
            <div class="height-fix">
                <img alt="logo" class="first-jpg bottom-boxes" src="public/img/articles/money.svg">
            </div>
            <div>
                <div class="header">
                    <?php if (isset($articles)) {
                        echo $articles[2]->getHeader();
                    } ?>
                </div>
                <div class="description">
                    <?php if (isset($articles)) {
                        echo $articles[2]->getContent();
                    } ?>
                </div>
                <div class="details">
                    <div class="like-and-comments">
                        <img alt="like" src="public/img/articles/like.svg">
                        <?php if (isset($articles)) {
                            echo $articles[2]->getLikes();
                        } ?>
                    </div>
                    <div class="like-and-comments">
                        <img alt="comment" src="public/img/articles/comment.svg">
                        <?php if (isset($articles)) {
                            echo $articles[2]->getComments();
                        } ?>
                    </div>
                </div>

            </div>
        </a>
        <a href="#" class="other-boxes">
            <div class="height-fix">
                <img alt="logo" class="first-jpg bottom-boxes" src="public/img/articles/sale.svg">
            </div>
            <div>
                <div class="header">
                    <?php if (isset($articles)) {
                        echo $articles[3]->getHeader();
                    } ?>
                </div>
                <div class="description">
                    <?php if (isset($articles)) {
                        echo $articles[3]->getContent();
                    } ?>
                </div>
                <div class="details">
                    <div class="like-and-comments">
                        <img alt="like" src="public/img/articles/like.svg">
                        <?php if (isset($articles)) {
                            echo $articles[3]->getLikes();
                        } ?>
                    </div>
                    <div class="like-and-comments">
                        <img alt="comment" src="public/img/articles/comment.svg">
                        <?php if (isset($articles)) {
                            echo $articles[3]->getComments();
                        } ?>
                    </div>
                </div>

            </div>
        </a>
        <a href="#" class="other-boxes">
            <div class="height-fix">
                <img alt="logo" class="first-jpg bottom-boxes" src="public/img/articles/car.svg">
            </div>
            <div>
                <div class="header">
                    <?php if (isset($articles)) {
                        echo $articles[4]->getHeader();
                    } ?>
                </div>
                <div class="description">
                    <?php if (isset($articles)) {
                        echo $articles[4]->getContent();
                    } ?>
                </div>
                <div class="details">
                    <div class="like-and-comments">
                        <img alt="like" src="public/img/articles/like.svg">
                        <?php if (isset($articles)) {
                            echo $articles[4]->getLikes();
                        } ?>
                    </div>
                    <div class="like-and-comments">
                        <img alt="comment" src="public/img/articles/comment.svg">
                        <?php if (isset($articles)) {
                            echo $articles[4]->getComments();
                        } ?>
                    </div>
                </div>

            </div>
        </a>
    </div>

    <nav id="bottom-default">
        <ul>
            <li>
                <a class="line" href="#" >
                  <span class="material-icons">
                        settings
                    </span>
                    Settings
                </a>
            </li>

            <li>
                <a class="line" href="#">
                <span class="material-icons">
                        logout
                </span>
                    Log out
                </a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>