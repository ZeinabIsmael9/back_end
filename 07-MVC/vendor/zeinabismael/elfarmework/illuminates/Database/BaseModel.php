<?php
namespace Illuminates\Database;

use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use Illuminates\Database\Types\MySQLConnection;
use Illuminates\Database\Types\SQLiteConnection;
use Illuminates\Logs\Log;
use PDO;

class BaseModel
{
    protected PDO $db;

    public function __construct(DatabaseConnectionInterface $connect)
    {
        $this->db = $connect->getPDO();
    }
}