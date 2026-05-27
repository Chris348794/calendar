<?php

require('config.php');


class Database {
    public $host;
    public $port;
    public $dbname;
    public $user;
    public $pass;
    public $pdo;

    function construct($config) {

        $dsn = ("mysql:" . http_build_query($config, '', ';'));
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
        };
    }

    function query($query, $params = []) {
        try {
            $statement = $this->pdo->prepare($query);
            $success = $statement->execute($params);
            
            if (stripos(trim($query), 'SELECT') === 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return $success; 
            
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}

$db = new Database();
$db->user = $user;
$db->pass = $pass;

class Event {
    public $name;
    public $moment;
    public $repeatType;
    public $repeatDuration;
    public $isDeadline;
};