<?php
if(!isset($_SESSION['id'])) {
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/movies.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <title>MOVIES</title>
</head>

<body>
    <main>
        <header>
            <div class="main-logo">
                <img src="public/img/logo.svg">
            </div>
            <div class="search">
                <form>
                    <input placeholder="search movie">
                </form>
            </div>
            <div class="buttons">
                <a href="#" class="fa-solid fa-user"></a>
                <a href="#" class="fa-solid fa-arrow-right-from-bracket"></a>
            </div>
        </header>
        <section class="movies">
            <div id="movie-1">
                <img src="public/img/uploads/<?= $movie->getImg() ?>">
                <div>
                    <h2><?= $movie->getTitle() ?></h2>
                    <p><?= $movie->getDescription() ?></p>
                    <div class="ratings">
                        <i class="fa-solid fa-thumbs-up"> 156</i>
                        <i class="fa-solid fa-thumbs-down"> 25</i>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>