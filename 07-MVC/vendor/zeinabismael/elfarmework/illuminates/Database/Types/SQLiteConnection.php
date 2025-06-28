<?php

namespace Illuminates\Database\Types;

use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

class SQLiteConnection implements DatabaseConnectionInterface

{
    private PDO $pdo;
    protected $path;

    public function __construct(){
        $config = config('database.drivers');
        $this->path = $config['sqlite']['path'];
        $dsn = "sqlite:" . $this->path;
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPDO(): PDO
    {
        // echo "MySQLite Connection Successfully";
        return $this->pdo;
    }
}
