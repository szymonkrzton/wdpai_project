<?php

require_once 'AppController.php';

class MoviesController extends AppController {

    public function movies($id = null) {

        if($id) {
            return $this->render('movie', ['id' => $id]);
        }

        $movies = [
            'WDPAI', 'WDSI', "IO"
        ];

        return $this->render('movies', ['movies' => $movies]);

    }
}