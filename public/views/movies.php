<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/movies.css">
    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/likes.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <a href="movie?_id=<?= $movie->getId() ?>" class="img-links">
                <img src="public/img/uploads/<?= $movie->getImg() ?>">
                </a>
                <div>
                    <a href="movie?_id=<?= $movie->getId() ?>" class="title-links">
                    <h2><?= $movie->getTitle() ?></h2>
                    </a>
                    <p><?= $movie->getTruncatedDescription(100) ?></p>
                    <div class="ratings">
                        <i class="fa-solid fa-thumbs-up like-btn"><span class="likes"> <?= $movie->getLike() ?></span></i>
                        <i class="fa-solid fa-thumbs-down dislike-btn"><span class="dislikes"> <?= $movie->getDislike() ?></span></i>
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
        <a href="#" class="img-links">
        <img src="">
        </a>
        <div>
            <a href="#" class="title-links">
            <h2>title</h2>
            </a>
            <p>description</p>
            <div class="ratings">
                <i class="fa-solid fa-thumbs-up"><span class="likes"> 0</span></i>
                <i class="fa-solid fa-thumbs-down"><span class="dislikes"> 0</span></i>
            </div>
        </div>
    </div>
</template>
