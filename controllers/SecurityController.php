<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login(){
        session_start();

        $userRepository = new UserRepository();

        if (isset($_SESSION['logged'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/movies");
        }


        if(!$this->isPost()){
            return $this->render('login');
        }



        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exist']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist']]);
        }

        if($user->getPassword() !== sha1($password)) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }


        $_SESSION['id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['name'] = $user->getName();
        $_SESSION['surname'] = $user->getSurname();
        $_SESSION['id_permission'] = $user->getIdPermission();
        $_SESSION['logged'] = true;

        //setcookie('permission', $user->getIdPermission(), time() + (86400 * 30), "/");

//        return $this->render('movies');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/movies");
    }

    public function register(){

        session_start();
        if (isset($_SESSION['logged'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/movies");
        }

        if(!$this->isPost()){
            return $this->render('register');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User($email, sha1($password), $name, $surname);
        $user->setPhone($phone);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function account(){
        if(!$this->isPost()){
            return $this->render('account');
        }

        if(isset($_POST['mail']))
        {
            $email = $_POST["email"];
            $this->userRepository->updateMail($email);

            return $this->render('account', ['messages' => ['Your email has been updated']]);
        } else {
            return $this->render('account', ['messages' => ['Please provide email']]);
        }

        if(isset($_POST['pass']))
        {
            $password = $_POST["password"];
            $this->userRepository->updatePassword($password);

            return $this->render('account', ['messages' => ['Your password has been updated']]);
        } else {
            return $this->render('account', ['messages' => ['Please provide password']]);
        }

    }

    public function logout()
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        if (!$this->isGet()) {
            header("Location: {$url}/login");
            return;
        }
        session_start();
        session_destroy();
        header("Location: {$url}/login");
    }
}