<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/movies.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/movie.css">

    <script src="https://kit.fontawesome.com/d61971956d.js" crossorigin="anonymous"></script>
    <title>MOVIE</title>
</head>

<body>
    <main>
        <header style="background-image: url('public/img/uploads/<?= $movie->getImg() ?>');">
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
        <section class="description">
            <div class="content">
                <h1><?= $movie->getTitle() ?></h1>
                <p><?= $movie->getDescription() ?></p>
                
            </div>
        </section>
    </main>
</body>

</html>