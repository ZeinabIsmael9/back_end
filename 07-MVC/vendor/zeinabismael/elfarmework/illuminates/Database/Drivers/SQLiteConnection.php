<?php

namespace Illuminates\Database\Drivers;

use Exception;
use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use Illuminates\Logs\Log;
use PDO;

class SQLiteConnection implements DatabaseConnectionInterface

{
    private PDO $pdo;
    protected $path;

    public function __construct()
    {
        $config = config('database.drivers');
        $this->path = $config['sqlite']['path'];
        $dsn = "sqlite:" . $this->path;
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Log($e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        // echo "MySQLite Connection Successfully";
        return $this->pdo;
    }
}
