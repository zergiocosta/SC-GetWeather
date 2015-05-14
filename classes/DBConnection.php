<?php
class DBConnection {

    private $connection;
    private $host;
    private $dbName;
    private $user;
    private $password;


    function init($host, $user, $password, $dbName) {

        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;

        return $this->tryConnection();
    }


    private function tryConnection()
    {
        $dsn = "mysql:dbname={$this->dbName};host={$this->host}";
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
            //return $connection;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $this->connection;

    }
}