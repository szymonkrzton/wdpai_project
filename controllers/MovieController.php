<?php

require_once ('AppController.php');
require_once __DIR__.('/../models/Movie.php');
require_once __DIR__.'/../repository/MovieRepository.php';

class MovieController extends AppController {
    const MAX_SIZE = 1920*1080;
    const TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    const UPLOAD = '/public/img/uploads/';

    private $message = [];
    private $movieRepository;

    public function __construct()
    {
        parent::__construct();
        $this->movieRepository = new MovieRepository();
    }


    public function addMovie() {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD.$_FILES['file']['name']);
            $movie = new Movie($_POST['movie-title'], $_POST['movie-description'], $_FILES['file']['name']);
            $this->movieRepository->addMovie($movie);
            return $this->render('movies', ['messages' => $this->message, 'movie' => $movie]);
        }
        return $this->render('addMovie', ['messages' => $this->message]);
    }

    public function validate(array $file): bool {
        if($file['size'] > self::MAX_SIZE) {
            $this->message[] = 'Plik jest zbyt duży!';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::TYPES)) {
            $this->message[] = 'Podany format pliku jest niepoprawny!';
            return false;
        }
        return true;
    }

}