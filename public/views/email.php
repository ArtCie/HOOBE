<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/email.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg" alt="logo">
        </div>
        <div class="login-container">
            <form class="login-container" action="email" method="POST">
                <div class="text">
                    Hey! Your first time? ;))
                </div>
                <div class="message-display">
                    <?php if(isset($message)){
                        echo $message;
                    } ?>
                </div>
                <input class="input" name="email" placeholder="Enter email address" type="text">

                <div class="button button-6">
                    <div class="spin"></div>
                    <button>Next</button>
                </div>

                <div class="text">
                    Or login with
                </div>

                <div class="custom-login">
                    <img class="margin" src="public/img/custom_login_logos/facebook.svg" alt="facebook">
                    <img class="margin" src="public/img/custom_login_logos/twitter.svg" alt="twitter">
                    <img src="public/img/custom_login_logos/gmail.svg" alt="gmail">
                </div>
            </form>
        </div>

    </div>
</body>
</html>