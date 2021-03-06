<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <form action="login" method="POST">
        <div class="text">
            Long time no see!
        </div>
        <input class="input"  name="password" placeholder="Enter password" type="password">

        <div class="forgot-password-button">
            <button class="forgot-password">Forgot your password?</button>
        </div>

        <div class="button button-6">
            <div class="spin"></div>
            <button type="submit">Next</button>
        </div>
    </form>
  </div>
</body>
</html>