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

    public function movies() {
        $movies = $this->movieRepository->getMovies();
        $this->render('movies', ['movies' => $movies]);
    }

    public function movie() {
        $movie = $this->movieRepository->getMovie($_GET['_id']);
        $this->render('movie', ['movie' => $movie]);
    }


    public function addMovie() {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD.$_FILES['file']['name']);
            $movie = new Movie($_POST['movie-title'], $_POST['movie-description'], $_FILES['file']['name']);
            $this->movieRepository->addMovie($movie);
            return $this->render('movies', [
                'movies' => $this->movieRepository->getMovies(),
                'messages' => $this->message
            ]);
        }
        return $this->render('addMovie', ['messages' => $this->message]);
    }

    public function like(int $id) {
        $this->movieRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->movieRepository->dislike($id);
        http_response_code(200);
    }

    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header("Content-Type: application/json");
            http_response_code(200);

            echo json_encode($this->movieRepository->getMovieByTitle($decoded['search']));
        }
    }

    private function validate(array $file): bool {
        if($file['size'] > self::MAX_SIZE) {
            $this->message[] = 'Plik jest zbyt du??y!';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::TYPES)) {
            $this->message[] = 'Podany format pliku jest niepoprawny!';
            return false;
        }
        return true;
    }


}