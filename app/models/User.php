<?php

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'user'");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function userNumber()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->rowCount();
        return $users;
    }

    public function getUserById($id)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE user_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE email = :email");
        $stmt->execute(array(
            ':email' => $email
        ));

        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $stmt = $this->db->query('INSERT INTO users (first_name,last_name,email,password,gender,age,created_at) VALUES (:first_name,:last_name,:email,:password,:gender,:age,:created_at)');
        if ($stmt->execute(array(
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':gender' => $data['gender'],
            ':age' => $data['age'],
            ':created_at' => $data['created_at'],
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE email = :email");
        $stmt->execute(array(
            ':email' => $data['email']
        ));

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            return false;
        }

        $hashPassword = $user->password;
        if (password_verify($data['password'], $hashPassword)) {
            return $user;
        } else {
            return false;
        }
    }

    public function delete($user_id)
    {
        $stmt = $this->db->query("DELETE FROM users WHERE user_id = :user_id");
        if ($stmt->execute(array(
            ':user_id' => $user_id
        ))) {
            return true;
        } else {
            return false;
        }
    }
}
