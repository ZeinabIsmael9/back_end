<?php

namespace Illuminates\Database;

use Illuminates\Database\Types\MySQLConnection;
use Illuminates\Database\Types\SQLiteConnection;
use Illuminates\Logs\Log;

class Model extends BaseModel
{
    public function __construct()
    {
        $config = config('database.driver');
        if($config == 'mysql'){
            parent::__construct(new MySQLConnection());
        }elseif($config == 'sqlite'){
            parent::__construct(new SQLiteConnection());
        }else{
            throw new Log('Database driver not found');
        }
    }
}