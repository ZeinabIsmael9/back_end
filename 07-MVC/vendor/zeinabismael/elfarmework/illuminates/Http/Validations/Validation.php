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

    /**
     * Retrieve a specific value from the given request data.
     *
     * @param array|object $request The data to retrieve the value from, either as an array or an object.
     * @param string $key The key of the value to retrieve.
     *
     * @return mixed The value associated with the given key if it exists, empty string otherwise.
     */
    public static function request(array|object $request, string $key)
    {
        return isset($request[$key]) ? $request[$key] : '';
    }


    /**
     * Validate the given request data against the specified rules and attributes.
     *
     * @param array|object $request The data to be validated, either as an array or an object.
     * @param array $rules An associative array where keys represent the request fields and values are validation rules.
     * @param array|null $attributes An optional associative array of attributes, used for error message customization.
     *
     * @throws Log If a specified validation method does not exist.
     *
     * @return static The function populates $errors for failed validations or $validated for successful ones. A new instance of the class is returned for chaining.
     */
    public static function make(array|object $requests, array $rules, array|null $attributes = [])
    {
        foreach ($rules as $rule_key => $rule_value) {
            $value = self::request($requests, $rule_key);
            $real_rule_key = explode('.', $rule_key)[0];
            $attribute = self::attribute($attributes, $real_rule_key);

            foreach (array_values(self::rule($rule_value)) as $rule) {
                $method = self::getMethodName($rule);

                if (!is_string($method) || !method_exists(new self, $method)) {
                    throw new Log('Invalid or missing validation method: ' . $method);
                } elseif (preg_match('/^in:|^unique:|^exists:/i', $rule)) {
                    if (self::$method($rule, $value)) {
                        if (preg_match('/^in:/i', $rule)) {
                            $attribut_in = explode(':', $rule);
                            $attribute = $attribute . ' - ' . $attribut_in[1];
                        } else {
                            $attribute = $attribute;
                        }
                        self::add_error($rule_key, $method, $attribute);
                    }
                } elseif (preg_match('/\./i', $rule_key)) {
                    self::validate_sub_value($rule_key, $requests, $attribute, $rule);
                } elseif (self::$method($value)) {
                    self::add_error($rule_key, $rule, $attribute);
                } else {
                    self::$validated[$rule_key] = $value;
                }
            }
        }
        return new self;
    }


    /**
     * Get the validated data.
     *
     * @return array
     */

    public static function validated()
    {
        return static::$validated;
    }

    /**
     * Get the failed validation data.
     *
     * @return array
     */
    public static function failed()
    {
        return static::$errors;
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
    /**
     * Add an error to the errors array. The error is added with the key as the array key and the value as a translation of the validation rule.
     * The translation is looked up in the validation.php language file and should be in the format of 'validation.rule'.
     *
     * @param string $key The key of the error to add.
     * @param string $rule The validation rule to use for the error message.
     * @param string $attribute The attribute to use in the error message.
     *
     * @return void
     */
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
