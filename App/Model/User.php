<?php

namespace App\Model;

use App\Model;
use PDO;

class User extends Model
{
    public function register(array $data): bool
    {
        $data["token"] = md5(uniqid());

        $result = $this->query(
            "INSERT INTO user (
                name, email, password, token
            ) VALUES (
                :name, :email, :password, :token
            )",
            $this->mapToBind([
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => password_hash($data["password"], PASSWORD_DEFAULT),
                "token" => $data["token"]
            ])
        );

        return true;
    }

    public function updatePassword(string $email, string $password): bool
    {
        $result = $this->query(
            "UPDATE user SET
                    password = :password,
                    token = :token
                WHERE email = ':email'
            ",
            $this->mapToBind([
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "token" => md5(uniqid())
            ])
        );

        return true;
    }

    public function getUserByEmail(string $email): array
    {
        $result = $this->query(
            "SELECT id, name, email, password, token FROM user
				WHERE email = :email
			",
            $this->mapToBind(["email" => $email])
        );

        $user = $result->fetch(PDO::FETCH_ASSOC);

        return ($result->rowCount()) ? $user : [];
    }

    public function getUserByToken(string $token): array
    {
        $result = $this->query(
            "SELECT id, name, email, password, token FROM user
				WHERE token = :token
			",
            $this->mapToBind(["token" => $token])
        );

        $user = $result->fetch(PDO::FETCH_ASSOC);

        return ($result->rowCount()) ? $user : [];
    }
}
