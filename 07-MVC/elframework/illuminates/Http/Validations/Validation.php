<?php

namespace Illuminates\Http\Validations;

use Illuminates\Http\Validations\Types\DataTypeValidations;
use Illuminates\Logs\Log;

class Validation
{
    use DataTypeValidations;

    protected static $errors = [];
    public static function make(array|object $request, array $rules, array|null $attributes = [])
    {
        //print_r($rules);
        // print_r($attributes);
        foreach ($rules as $rule_key => $rule_value) {
            $value = $request[$rule_key];
            $attribute = self::attribute($attributes, $rule_key);
            foreach (array_values(self::rule($rule_value)) as $rule) {
                if (!method_exists(new self, $rule)) {
                    throw new Log('There is no validation called ' . $rule);
                } elseif (self::$rule( $value)) {
                    static::$errors[$rule_key][] = trans('validation.'.$rule , ['attribute' => $attribute]);
                }
            }
        }
        var_dump(static::$errors);
    }


    /**
     * @param string|array $rule
     * 
     * @return array
     */
    private static function rule(string|array $rule): array
    {
        return is_array($rule) ? $rule : explode('|', $rule);
    }

    /**
     * @param mixed $attributes
     * @param mixed $key
     * 
     * @return string
     */
    private static function attribute($attributes, $key): string
    {
        return isset($attributes[$key]) ? $attributes[$key] : $key;
    }
}
