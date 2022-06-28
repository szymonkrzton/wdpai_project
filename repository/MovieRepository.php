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
session_start();
        $id = $_SESSION['id'];

        $stmt->execute([
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
            SELECT * FROM movies ORDER BY id
        ');
        $stmt->execute();
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($movies as $movie) {
            $result[] = new Movie(
                $movie['title'],
                $movie['description'],
                $movie['img'],
                $movie['like'],
                $movie['dislike'],
                $movie['id']
            );
        }

        return $result;
    }



//    public function like(int $id) {
//        $stmt = $this->database->connect()->prepare('
//            UPDATE movies SET "like" = "like" + 1 WHERE id = :id
//        ');
//
//        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//        $stmt->execute();
//    }
//
//    public function dislike(int $id) {
//        $stmt = $this->database->connect()->prepare('
//            UPDATE movies SET dislike = dislike + 1 WHERE id = :id
//        ');
//
//        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//        $stmt->execute();
//    }

    public function getMovieByTitle(string $searchString){
        $searchString = '%'.strtolower($searchString).'%';


        $stmt = $this->database->connect()->prepare('
            SELECT * FROM movies WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search ORDER BY id
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like($id_movie, $action) {
        session_start();
        $id_user = $_SESSION['id'];

        $stmt = $this->database->connect()->prepare("
            INSERT INTO stats (id_movie, id_user, rating_action) 
            VALUES (?, ?, ?) 
            ON CONFLICT (id_movie, id_user) WHERE id_movie = $id_movie AND id_user = $id_user DO UPDATE SET rating_action='like'
        ");

        $stmt->execute([
            $id_movie,
            $id_user,
            $action
        ]);
    }

    public function dislike($id_movie, $action) {
        session_start();
        $id_user = $_SESSION['id'];

        $stmt = $this->database->connect()->prepare("
            INSERT INTO stats (id_movie, id_user, rating_action) 
            VALUES (?, ?, ?) 
            ON CONFLICT (id_movie, id_user) WHERE id_movie = $id_movie AND id_user = $id_user DO UPDATE SET rating_action='dislike'
        ");

        $stmt->execute([
            $id_movie,
            $id_user,
            $action
        ]);
    }

    public function unlike($id_movie) {
        session_start();
        $id_user = $_SESSION['id'];

        $stmt = $this->database->connect()->prepare("
            DELETE FROM stats WHERE id_user = :id_user AND id_movie = :id_movie
        ");

        $stmt->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam('id_movie', $id_movie, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function undislike($id_movie) {
        session_start();
        $id_user = $_SESSION['id'];

        $stmt = $this->database->connect()->prepare("
            DELETE FROM stats WHERE id_user = :id_user AND id_movie = :id_movie
        ");

        $stmt->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam('id_movie', $id_movie, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function getRating($id_movie) {
        $likes_stmt = $this->database->connect()->prepare("
            SELECT COUNT(*) FROM stats WHERE id_movie = $id_movie AND rating_action='like'
        ");

        $dislikes_stmt = $this->database->connect()->prepare("
            SELECT COUNT(*) FROM stats WHERE id_movie = $id_movie AND rating_action='dislike'
        ");

        $likes_stmt->execute();
        $dislikes_stmt->execute();

        $likes = $likes_stmt->fetchAll(PDO::FETCH_ASSOC);
        $dislikes = $dislikes_stmt->fetchAll(PDO::FETCH_ASSOC);

        $rating = [
            'likes' => $likes[0]['count'],
            'dislikes' => $dislikes[0]['count']
        ];

        return json_encode($rating);
    }
}