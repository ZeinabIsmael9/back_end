<?php

namespace App\Models;

use Illuminates\Database\Model;

class User extends Model
{
    // protected $table = 'users'; 
    public function __construct()
    {
        parent::__construct();
        var_dump($this->table);
    }
}
