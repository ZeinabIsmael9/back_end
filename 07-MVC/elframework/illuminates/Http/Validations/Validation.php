<?php

namespace Illuminates\Http\Validations;

use Illuminates\Http\Validations\Types\CheckInArrayValidations;
use Illuminates\Http\Validations\Types\DataTypeValidations;
use Illuminates\Http\Validations\Types\QueryValidations;
use Illuminates\Logs\Log;

class Validation
{
    use DataTypeValidations, CheckInArrayValidations, QueryValidations;
    protected static $errors = [];
    protected static $validated = [];

    public static function request(array|object $request, string $key)
    {
        return isset($request[$key]) ? $request[$key] : '';
    }
    public static function make(array|object $request, array $rules, array|null $attributes = [])
    {
        $requests = is_object($request) ? (array) $request : $request;

        foreach ($rules as $rule_key => $rule_value) {
            $value = self::request($request, $rule_key);
            $reel_rule_key = explode('.', $rule_key)[0];
            $attribute = self::attribute($attributes, $reel_rule_key);

            foreach (array_values(self::rule($rule_value)) as $rule) {
                $method = self::getMethodName($rule);
                if (!method_exists(new self, $method)) {
                    throw new Log('There is no validation called ' . $method . ' in the Validation class.');
                } elseif (preg_match("/^in:/i", $rule) || preg_match("/^unique:/i", $rule) || preg_match("/^exists:/i", $rule)) {
                    if (!self::$method($rule, $value)) {
                        if (preg_match("/^in:/i", $rule)) {
                            $attribute_in = explode(':', $rule);
                            self::add_error($rule_key, $method, $attribute);
                            $attribute = $attribute . ' - ' . $attribute_in[1];
                        } else {
                            $attribute = $attribute;
                        }
                        self::add_error($rule_key, $method, $attribute);
                    }
                }
                // elseif (preg_match("/^unique:/i", $rule)) {
                //     if (!self::$method($rule, $value)) {
                //         // var_dump($rule);
                //         self::add_error($rule_key, $method, $attribute);
                //     }
                // }  elseif (preg_match("/^exists:/i", $rule)) {
                //     if (!self::$method($rule, $value)) {
                //         // var_dump($rule);
                //         self::add_error($rule_key, $method, $attribute);
                //     }
                // } 
                elseif (preg_match("/\./", $rule_key)) {
                    self::validate_sub_value($rule_key, $requests, $rule, $attribute);
                } elseif (self::$method($value)) {
                    self::add_error($rule_key, $rule, $attribute);
                } else {
                    self::$validated[$rule_key] = $value;
                }
            }
        }
        echo '<pre>';
        // var_dump(static::$validated);
        var_dump(static::$errors);
        echo '</pre>';
    }

    /**
     *
     * @param mixed $rule
     * @return void
     */
    protected static function getMethodName(mixed $rule): string
    {
        if (preg_match("/^in:/i", $rule)) {
            return 'in';
        } elseif (preg_match("/^unique:/", $rule)) {
            return 'unique';
        } elseif (preg_match("/^exists:/", $rule)) {
            return 'exists';
        } else {
            return $rule;
        }
    }
    /**
     * @param mixed $rule_key
     * @param mixed $requests
     * @param mixed $rule
     * @param mixed $attribute
     * 
     * @return [type]
     */
    protected static function validate_sub_value($rule_key, $requests, $rule, $attribute)
    {
        $split_key = explode('.', $rule_key);
        if (isset($split_key[1]) && $split_key[1] == '*' && is_array($requests[$split_key[0]])) {
            $index = 0;
            foreach ($requests[$split_key[0]] as $array_value) {
                if (self::$rule($array_value)) {
                    self::add_error($split_key[0], $rule, $attribute . '(' . $index . ')');
                }
                $index++;
            }
        } elseif (is_array($requests[$split_key[0]]) && isset($requests[$split_key[0]]) && isset($split_key[1])) {
            $select_request = $requests[$split_key[0]];
            if (isset($select_request[$split_key[1]])) {
                if (self::$rule($select_request[$split_key[1]])) {
                    self::add_error($split_key[0], $rule, $attribute . '(' . $split_key[1] . ')');
                }
            }
        }
    }
    private static function add_error($key, $rule, $attribute): void
    {
        static::$errors[$key][] = trans('validation.' . $rule, ['attribute' => $attribute]);
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
