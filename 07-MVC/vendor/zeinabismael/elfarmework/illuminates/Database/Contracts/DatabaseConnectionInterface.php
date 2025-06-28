<?php

namespace Illuminates\Database\Contracts;

use PDO;

interface DatabaseConnectionInterface
{
    public function getPDO(): PDO;
}