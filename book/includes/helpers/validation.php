<?php
if (!function_exists('validation')) {
    function validation(array $attributes, array $trans = null, $http_header = 'redirect', $back = null) {
        $validations = [];
        $values = [];
        foreach ($attributes as $attribute => $rules) {
            $value = request($attribute);
            $values[$attribute] = $value;
            $attribute_validate = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;

            foreach (explode('|', $rules) as $rule) {
                // var_dump($rule);
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.email'));
                } elseif ($rule == 'required' && (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])))) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.required'));
                } elseif ($rule == 'integer' && !filter_var((int)$value, FILTER_VALIDATE_INT)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.integer'));
                } elseif ($rule == 'string' && !is_string($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.string'));
                } elseif ($rule == 'numeric' && !is_numeric($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.numeric'));
                } elseif ($rule == 'image' && isset($value['tmp_name']) && (!empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.image'));
                } elseif (strpos($rule, 'in:') === 0) {
                    $ex_rule = explode(':', $rule);
                    $ex_in = explode(',', $ex_rule[1]);
                    if (is_array($ex_in) && !in_array($value, $ex_in)) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.in'));
                    }
                } elseif (preg_match('/^unique:/i', $rule)) {
                    $ex_rule = explode(':', $rule);
                    if (count($ex_rule) > 1 && isset($ex_rule[1])) {
                        $get_unique_info = explode(',', $ex_rule[1]);
                        $table = $get_unique_info[0];
                        $column = isset($get_unique_info[1]) ? $get_unique_info[1] : $attribute;
                        
                        if (isset($get_unique_info[2])) {
                            $sql = "WHERE " . $column . "='" . $value . "' AND id !='" . $get_unique_info[2] . "'";
                        } else {
                            $sql = "WHERE " . $column . "='" . $value . "'";
                        }
                        //var_dump($sql);
                        $check_unique_db = db_frist($table, $sql);

                        if (!empty($check_unique_db)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.unique'));
                        }
                    }
                } elseif (preg_match('/^exists:/i', $rule)) {
                    $ex_rule = explode(':', $rule);
                    if (count($ex_rule) > 1 && isset($ex_rule[1])) {
                        $get_exists_info = explode(',', $ex_rule[1]);
                        $table = $get_exists_info[0];
                        //var_dump($table);
                        $column = isset($get_exists_info[1]) ? $get_exists_info[1] : $attribute;
                        
                        if (isset($get_exists_info[2])) {
                            $sql = "WHERE " . $column . "='" . $value . "'";
                        } else {
                            $sql = "WHERE id='" . $value . "'";
                        }
                        //var_dump($sql);
                        $check_exists_db = db_frist($table, $sql);

                        if (empty($check_exists_db)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.exists'));
                        }
                    }
                }
            
            }
        
            if (!empty($attribute_validate)) {
                $validations[$attribute] = $attribute_validate;
            }
            
        }
        if (count($validations)>0) {
            if ($http_header == 'redirect') {
                session('errors', json_encode($validations));
                session('old', json_encode($values));
                if (!is_null($back)) {
                    redirect($back);
                } else {
                    back();
                }
            } elseif ($http_header == 'api') {
                // response($validations ,422);
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(422);
                echo json_encode($validations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        } else {
            return $values;
        }
    }
}



if (!function_exists('any_errors')) {
    function any_errors($offset = null)
    {
        $array = json_decode(session('errors'), true);
        if ($array === null) {
            $array = [];
        }
        if ($offset !== null && isset($array[$offset])) {
            return $array[$offset];
        } elseif (!empty($array)) {
            return $array;
        } else {
            return [];
        }
    }
}

if (!function_exists('all_errors')) {
    function all_errors()
    {
        $all_errors = [];
        foreach (any_errors() as $errors) {
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    $all_errors[] = $error;
                }
            }
        }
        return $all_errors;
    }
}

if (!function_exists('get_error')) {
    function get_error($offset)
    {
        $errors = any_errors($offset);
        if (empty($errors)) return null;  // Return null if there are no errors for this offset

        $error = '<ul>';
        foreach ($errors as $error_string) {
            // Check if $error_string is an array and handle it
            if (is_array($error_string)) {
                foreach ($error_string as $single_error) {
                    $error .= "<li>" . htmlspecialchars($single_error) . "</li>";  // Escaping each error message
                }
            } else {
                $error .= "<li>" . htmlspecialchars($error_string) . "</li>";  // Escaping a single error message
            }
        }
        $error .= '</ul>';
        return $error;
    }
}


if (!function_exists('end_errors')) {
    function end_errors()
    {
        session_flash('errors');
    }
}

if (!function_exists('old')) {
    function old($request)
    {
        $old_values = json_decode(session('old'), true);
        if (is_array($old_values) && !empty($old_values) && array_key_exists($request, $old_values)) {
            return $old_values[$request];
        } else {
            return '';
        }
    }
}
