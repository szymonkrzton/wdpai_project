<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <title>ADD MOVIE</title>
</head>

<body>
    <main>
        <header>
            <div class="main-logo">
                    <img src="public/img/logo.svg">
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
        <div class="add-movie">
            <form class="add-movie-form" action="addMovie" method="POST" enctype="multipart/form-data">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach ($messages as $message){
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <p class="add-movie-p">Tytuł</p>
                <input name="movie-title" type="text" placeholder="podaj tytuł">
                <p class="add-movie-p">Opis</p>
                <textarea name="movie-description" rows="4" cols="50" placeholder="podaj opis filmu"></textarea>
                <p class="add-movie-p">Dodaj zdjęcie</p>
                <input type="file" name="file">
                <button type='submit' id="add-movie-button">dodaj</button>
            </form>
        </div>
    </main>
</body>

</html>