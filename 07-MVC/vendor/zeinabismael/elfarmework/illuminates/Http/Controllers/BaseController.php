<?php
namespace Illuminates\Http\Controllers;

use Illuminates\Http\Validations\Validation;

class BaseController 
{
    //CRUD
    //C => Create => store
    //R => Read
    //U => Update =>edit
    //D => Destroy
    public function validated(array|object $requests, array $rules, array|null $attributes = [])
    {
        return Validation::make($requests, $rules, $attributes);
    }
}