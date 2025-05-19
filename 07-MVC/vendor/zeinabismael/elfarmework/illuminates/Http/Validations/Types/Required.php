<?php
namespace Illuminates\Http\Validations\Types;


trait Required 
{
protected static function required(array $rules, mixed $value)
{
    return (in_array('required', $rules) && (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name']))));
}


}