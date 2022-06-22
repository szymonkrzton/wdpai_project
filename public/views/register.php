<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER</title>
</head>

<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg" class="login-img">
    </div>
    <div class="login-container">
        <form class="login-form" action="register" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <button id="login-button" type="submit">zarejestruj</button>

        </form>
    </div>
</div>
</body>

</html>