<?php

namespace Illuminates\Http\Validations;

use Illuminates\Http\Validations\Types\Required;

class Validation
{
    use Required;

    protected static $errors = [];
    public static function make(array|object $request, array $rules, array|null $attributes = [])
    {
        //print_r($rules);
        // print_r($attributes);
        foreach ($rules as $rule_key => $rule_value) {
            $value = $request[$rule_key];
            $rules = array_values(self::rule($rule_value));
            $attribute = self::get_translate($attributes, $rule_key);

            if (in_array('required', $rules) && self::required($rules, $value)) {
                static::$errors[$rule_key] = [
                    trans('validation.required', ['attribute' => $attribute])
                ];
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
    private static function attribute($attributes, $key):string
    {
        return isset($attributes[$key]) ? $attributes[$key] : $key;
    }
}
