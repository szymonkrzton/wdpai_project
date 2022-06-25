<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/movies.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>MOVIES</title>
</head>

<body>
    <main>
        <header>
            <div class="main-logo">
                <img src="public/img/logo.svg">
            </div>
            <div class="search">

                    <input placeholder="search movie">

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
        <section class="movies">
            <?php foreach ($movies as $movie): ?>

            <div id="<?= $movie->getId() ?>">
                <img src="public/img/uploads/<?= $movie->getImg() ?>">
                <div>
                    <h2><?= $movie->getTitle() ?></h2>
                    <p><?= $movie->getDescription() ?></p>
                    <div class="ratings">
                        <i class="fa-solid fa-thumbs-up"><?= $movie->getLike() ?></i>
                        <i class="fa-solid fa-thumbs-down"><?= $movie->getDislike() ?></i>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>

<template id="movie-template">
    <div id="">
        <img src="">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="ratings">
                <i class="fa-solid fa-thumbs-up">0</i>
                <i class="fa-solid fa-thumbs-down">0</i>
            </div>
        </div>
    </div>
</template>
