<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg" class="login-img">
        </div>
        <div class="login-container">
            <form class="login-form" action="login" method="POST">
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
                <button id="login-button" type="submit">zaloguj</button>

            </form>
        </div>
    </div>
</body>

</html>