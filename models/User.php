<?php

class User
{
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;
    private $id;
    private $id_permission;

    public function __construct(string $email, string $password, string $name, string $surname, string $phone, int $id = null, int $id_permission = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->id = $id;
        $this->id_permission = $id_permission;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function setPhone(int $phone)
    {
        $this->phone = $phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getIdPermission(): int
    {
        return $this->id_permission;
    }

    public function setIdPermission(int $id_permission)
    {
        $this->id_permission = $id_permission;
    }


}