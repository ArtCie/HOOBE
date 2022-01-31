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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>HOOBE</title>
    <script async src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="public/js/initFile.js?1"></script>
    <script src="public/js/checkFilters.js?78"></script>
    <script src="public/js/logout.js"></script>
    <script src="public/js/adminManager.js"></script>
</head>
<body>

<div class="main">
    <nav>
        <ul>
            <li>
                <form action="main_page" method="POST">
                    <button type="submit">
                        <img alt="logo" src="public/img/logo.svg">
                    </button>
                </form>
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
                <form action="discounts" method="POST">
                    <button class="dropbtn">
                        <i class="fas fa-percent"></i>
                        Discounts
                    </button>
                </form>
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
        <div class="display_users">
            <div class="header bigger-header">
            Users + Comments
            </div>
                <?php if (isset($userComments)) {
                    foreach ($userComments as $key=>$userRepository): ?>
                        <div id="<?php echo "remove-all-" . $key ?>">
                        <div class="<?php echo "display-email display-email-" . $key ?>">
                        <?php echo $userRepository->getEmail(); ?>
                            <button onclick="removeUser('<?php echo $userRepository->getEmail()?>', '<?php echo $key?>')">
                                <span class="material-icons remove_button">
                                    clear
                                </span>
                            </button>
                        </div>
                        <?php
                            foreach ($userRepository->getComments() as $comment_key => $comment){ ?>
                                <div class="display-comment" id="<?php echo "remove_comment_" . $key . "_" . $comment_key ?>">
                                    <?php echo $comment["content"];?>
                                    <button onclick="removeComment('<?php echo $comment["id"]?>', '<?php echo "remove_comment_" . $key . "_" . $comment_key ?>')">
                                        <span class="material-icons remove_button">
                                            clear
                                        </span>
                                    </button>
                                </div>

                            <?php } ?>
                        </div>
                       <?php endforeach;} ?>
            </div>
        <div class="add_article">

        </div>


    <nav class="bottom">
        <ul>
            <li>
                <form action="settings" method="GET">
                    <button class="line">
                      <span class="material-icons">
                            settings
                        </span>
                        Settings
                    </button>
                </form>
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