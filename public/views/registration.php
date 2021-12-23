<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/email.css?3">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script async src="public/js/passwordValid.js?2"></script>
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg" alt="logo">
    </div>
    <form action="registration" method="POST">
        <div class="text">
            Join us!
        </div>
        <text></text>
        <input class="input" oninput="passwordValid()"  name="password" placeholder="Enter password" type="password">
        <text class="valid display-flex wrong">At least 8 characters</text>
        <text class="valid display-flex wrong">At least 1 lower case</text>
        <text class="valid display-flex wrong">At least 1 upper case</text>
        <text class="valid display-flex wrong">At least 1 numerical sign</text>
        <text class="valid display-flex wrong">At least 1 special sign</text>
        <div class="button button-6 opacity_none">
            <div class="spin"></div>
            <button>Next</button>
        </div>
    </form>
</div>
</body>
</html>