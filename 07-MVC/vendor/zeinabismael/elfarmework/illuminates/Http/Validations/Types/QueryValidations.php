<?php

namespace Illuminates\Http\Validations\Types;

trait QueryValidations
{
    protected static function unique(mixed $value = null, mixed $rule)
    {
        $unique_rule = explode(':', $rule);
        if (!empty($value)) {
            if (isset($unique_rule[1])) {
                $table = explode(',', $unique_rule[1])[0];
                $column = explode(',', $unique_rule[1])[1] ?? '';
                $validation_value = explode(',', $unique_rule[1])[2] ?? '';
                // var_dump($table, $column, $validation_value);
                return  $value == $validation_value ;
            }
        }
        return false;
    }

    protected static function exists(mixed $value = null, mixed $rule)
    {
        $exists_rule = explode(':', $rule);
        if (!empty($value)) {
            if (isset($exists_rule[1])) {
                $table = explode(',', $exists_rule[1])[0];
                $column = explode(',', $exists_rule[1])[1] ?? '';
                return  true ;
            }
        }
        return false;
    }
}
