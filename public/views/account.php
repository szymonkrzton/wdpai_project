<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <title>ACCOUNT</title>
</head>

<body>
    <main>
        <header>
            <div class="main-logo">
                <a href="movies">
                    <img src="public/img/logo.svg">
                </a>
            </div>
            <div class="buttons-account">
                <?php
                if($_SESSION['id_permission'] == 1):
                    ?>
                    <a href="addMovie" class="fa-solid fa-plus"></a>
                <?php
                endif;
                ?>
                <a href="account" class="fa-solid fa-user"></a>
                <a href="#" class="fa-solid fa-arrow-right-from-bracket"></a>
            </div>
        </header>
        <div class="manage-account">
            <form class="manage-account-form" action="account" method="post">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <p class="manage-account-p">Zmień e-mail</p>
                <input name="email" type="text" placeholder="email">
                <button id="email-change-button" type="submit" name="mail">zmień</button>
                <p class="manage-account-p">Zmień hasło</p>
                <input name="password" type="password" placeholder="password">
                <button id="password-change-button" type="submit" name="pass">zmień</button>
            </form>
        </div>
    </main>
</body>

</html>