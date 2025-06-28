<?php

namespace Illuminates\Database\Types;

use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class MySQLConnection implements DatabaseConnectionInterface

{
    private PDO $pdo;

        protected $username;
        protected $password;
        protected $database;
        protected $charset;
        protected $host;

    public function __construct() {
        $config = config('database.drivers');
        $this->host = $config['mysql']['host'];
        $this->database = $config['mysql']['database'];
        $this->charset = $config['mysql']['charset'];
        $this->username = $config['mysql']['username'];
        $this->password = $config['mysql']['password'];

        $dsn = "mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset;
        $this->pdo = new PDO($dsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPDO(): PDO
    {
        // echo "Connected to MySQL database: " . $this->database . "<br>";
        return $this->pdo;
    }
}
