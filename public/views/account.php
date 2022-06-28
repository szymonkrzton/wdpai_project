<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/update.js" defer></script>
    <title>ACCOUNT</title>
</head>

<body>
    <main>
        <header>
            <div class="main-logo">
                    <img src="public/img/logo.svg">
            </div>
            <div class="buttons">
                <a href="movies" class="fa-solid fa-house-chimney"></a>
                <?php
                if($_SESSION['id_permission'] == 1):
                    ?>
                    <a href="addMovie" class="fa-solid fa-plus"></a>
                <?php
                endif;
                ?>
                <a href="account" class="fa-solid fa-user"></a>
                <a href="logout" class="fa-solid fa-arrow-right-from-bracket"></a>
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

                <p class="manage-account-p">Zmień hasło</p>
                <input name="password" type="password" placeholder="password">
                <button class="update" type="submit" name="update-details">zmień</button>
            </form>
        </div>
    </main>
</body>

</html>