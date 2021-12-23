<?php

class RegistrationUser {
    private $email;
    private $password;

    public function __construct(
        string $password,
        string $email
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}