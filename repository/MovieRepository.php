<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Movie.php';

class MovieRepository extends Repository
{
    public function getMovie(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM movies WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$movie) return null;

        return new Movie(
            $movie['title'],
            $movie['description'],
            $movie['img']
        );
    }

    public function addMovie(Movie $movie)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO movies (id_user, title, description, img) VALUES (?, ?, ?, ?)
        ');

//TODO ID FROM SESSION
        $id = 1;

        $stmt->execute([
//            $_SESSION['id'],
            $id,
            $movie->getTitle(),
            $movie->getDescription(),
            $movie->getImg()
        ]);
    }

    public function getMovies(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM movies
        ');
        $stmt->execute();
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($movies as $movie) {
            $result[] = new Movie(
                $movie['title'],
                $movie['description'],
                $movie['img']
            );
        }

        return $result;
    }
}