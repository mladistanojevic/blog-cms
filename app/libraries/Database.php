<?php

class Database
{

    private $dbName = DBNAME;
    private $dbHost = DBHOST;
    private $dbUser = DBUSER;
    private $dbPass = DBPASS;
    private $dbDriver = DRIVER;

    private $dbHandler;

    public function __construct()
    {
        $con = $this->dbDriver . ':host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbHandler = new PDO($con, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            die('Connection problem: ' . $e->getMessage());
        }
    }

    public function query($sql)
    {
        return $this->dbHandler->prepare($sql);
    }
}
