<?php
class DbManager {

    private $host, $port, $username, $password;

    public function __construct($host, $port, $username, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect($dbname) {
        try {
            $dsn = "mysql:dbname={$dbname};host={$this->host}";
            return new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            die("Errore di connessione al database: " . $e->getMessage());
        }
    }
}