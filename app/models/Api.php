<?php

class Api
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function search($text)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE first_name LIKE '%$text%'");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
