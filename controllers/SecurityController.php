<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login(){
//        if($_SESSION['logged']) {
//            header('Location: /movies');
//        }

        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->login('login');
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

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['name'] = $user->getName();
        $_SESSION['surname'] = $user->getSurname();
        $_SESSION['id_permission'] = $user->getIdPermission();
        $_SESSION['logged'] = true;

        return $this->render('movies');
    }

    public function register(){
        if(!$this->isPost()){
            return $this->register('register');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User($email, sha1($password), $name, $surname);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function account(){
        if(!$this->isPost()){
            return $this->account('account');
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
}