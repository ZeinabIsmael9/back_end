<?php
/** #206 Dependency Inversion Principle - DIP */
interface DBConnection{
    public function connect();
}
class MySQLConnect implements DBConnection
{
    public function connect()
    {
        echo "Connecting to MySQL database";
    }
}
class OracleConnect implements DBConnection
{
    public function connect(){
        echo "Connecting to Oracle database";
    }
}

class PostgreSql implements DBConnection
{
    public function connect()
    {
        echo "Connecting to PostgreSql database";
    }
}

// $mysql = new MySQLConnect;
// $mysql->connect();

class databaseRepository {
    private $db;
    public function __construct(DBConnection $DBConnection)
    {
        $this->db = $DBConnection;
    }
    public function getUsers()
    {
        $this->db->connect();
    }
}
$config = 'Oracle';

if($config=='mysql'){
    $inversion = new MySQLConnect;
}elseif($config=='Oracle'){
    $inversion = new OracleConnect;
}elseif($config=='Postgre'){
    $inversion = new PostgreSql;
}else{
    $inversion = new MySQLConnect;
}

$database = new databaseRepository($inversion);
$database->getUsers();