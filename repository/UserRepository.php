<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user) return null;

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['id_permission']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (name, surname, email, password)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getName(),
            $this->getSurname
        ]);
    }

    public function updateMail(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET email = :email WHERE id = :id
        ');
//TODO ID FROM SESSION
        $id = 1;

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updatePassword(string $password)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET password = :password WHERE id = :id
        ');
//TODO ID FROM SESSION
        $id = 1;

        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }
}