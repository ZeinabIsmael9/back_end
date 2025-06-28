<?php

namespace Illuminates\Database;

use Illuminates\Database\Drivers\MySQLConnection;
use Illuminates\Database\Drivers\SQLiteConnection;
use Illuminates\Logs\Log;

class Model extends BaseModel
{
    public function __construct()
    {
        $config = config('database.driver');
        if ($config == 'mysql') {
            parent::__construct(new MySQLConnection());
        } elseif ($config == 'sqlite') {
            parent::__construct(new SQLiteConnection());
        } else {
            throw new Log('Database driver not found');
        }
    }
}
