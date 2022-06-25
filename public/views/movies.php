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
                <a href="movies">
                <img src="public/img/logo.svg">
                </a>
            </div>
            <div class="search">
                <form>
                    <input placeholder="search movie">
                </form>
            </div>
            <div class="buttons">
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
        <section class="movies">
            <?php foreach ($movies as $movie): ?>
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
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>