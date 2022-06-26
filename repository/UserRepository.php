<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id, u.email, u.password, u.id_permission, ud.name, ud.surname, ud.phone FROM users u LEFT JOIN user_details ud ON u.id_user_details = ud.id WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user) return null;

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['phone'],
            $user['id'],
            $user['id_permission']
        );
    }

    public function addUser(User $user)
    {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function updateInfo(string $email, string $password)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET email = :email, password = :password WHERE id = :id
        ');

        session_start();
        $id = $_SESSION['id'];

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

}