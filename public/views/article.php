<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/email.css">
    <link rel="stylesheet" type="text/css" href="public/css/main_page.css">
    <link rel="stylesheet" type="text/css" href="public/css/toggle.css?2">
    <link rel="stylesheet" type="text/css" href="public/css/article.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>HOOBE</title>
    <script async src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="public/js/initFile.js?1"></script>
    <script src="public/js/checkFilters.js?78"></script>
    <script src="public/js/logout.js"></script>
    <script src="public/js/changeLikeState.js"></script>
    <script src="public/js/loadLikeState.js"></script>
    <script src="public/js/publishComment.js"></script>
    <script type="text/javascript" async>
        loadLikeState('<?php if(isset($isLike)){echo $isLike;}?>');
    </script>
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
                        <div class="toggle_text">
                            Bolt
                            <input type="checkbox" id="bolt_box" onclick="put_filters(); "/>
                            <div>
                                <label class="bolt_height" for="bolt_box"></label>
                            </div>
                        </div>
                        <div class="toggle_text">
                            Lime
                            <input type="checkbox" id="lime_box" onclick="put_filters()"/>
                            <div>
                                <label class="lime_height" for="lime_box"></label>
                            </div>
                        </div>
                        <div class="toggle_text">
                            Tier
                            <input type="checkbox" id="tier_box" onclick="put_filters()"/>
                            <div>
                                <label class="tier_height" for="tier_box"></label>
                            </div>
                        </div>
                        <div class="toggle_text">
                            Panek
                            <input type="checkbox" id="panek_box" onclick="put_filters()"/>
                            <div>
                                <label class="panek_height" for="panek_box"></label>
                            </div>
                        </div>
                        <div class="toggle_text">
                            Private vehicles
                            <input type="checkbox" id="private_vehicles_box" onclick="put_filters()"/>
                            <div>
                                <label class="private_vehicles_height" for="private_vehicles_box"></label>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" async>
                        load_filters()
                    </script>
                </div>
            </li>
            <li>
                <a href="#" class="dropbtn">
                    <i class="fas fa-percent"></i>
                    Discounts
                </a>
            </li>
            <li>
                <form class="login-container" action="rent_vehicle" method="GET">
                    <button type="submit" class="dropbtn">
                        <i class="fas fa-car"></i>
                        Rent your vehicle
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <div id="segment-split">
        <div></div>
        <div id="article">
            <h2>
                <?php if (isset($article)) {
                    echo $article->getHeader();
                } ?>
            </h2>
            <div class="content">
                <?php if (isset($article)) {
                    echo $article->getContent();
                } ?>
            </div>

            <div class="placement">
                <div class="heart" onclick="changeLikeState('<?php if(isset($article)){echo $article->getIndex();}?>')"></div>
            </div>
        </div>
        <div></div>
        <div id="comments">
            <div class="add-comment">
            <h2>Add comment</h2>

            <div class="text-area">
                <textarea name="text" class="comment resize" id="comment-content" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
            </div>

            <div class="button button-6 submit-button">
                <div class="spin"></div>
                <button onclick="publishComment('<?php if(isset($article)){echo $article->getIndex();}?>')">Submit</button>
            </div>

            </div>
            <h2>Comments</h2>
            <?php if (isset($comments)) {
                foreach ($comments as $key=>$comment): ?>
                <div class="comment" id=<?php echo "comment" . $key?>>
                    <div class="comment-header">
                        <div class="comment-author">
                            <?php echo $comment->getEmail();?>
                        </div>
                        <div class="comment-date">
                            <?php echo $comment->getTimestamp();?>
                        </div>
                    </div>
                    <div class="comment-content">
                        <?php echo $comment->getComment();?>
                    </div>
                </div>
            <?php   endforeach;} ?>
        </div>
    </div>
    <nav class="bottom">
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
                <button class="line" onclick="logout()">
                <span class="material-icons">
                        logout
                </span>
                    Log out
                </button>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>