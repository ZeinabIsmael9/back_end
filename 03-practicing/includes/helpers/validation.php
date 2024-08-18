<?php

if (!function_exists('validation')) {
    function validation(array $attributes, array $trans = null ,$http_header='redirect' ) {
        $validations = [];
        $values = [];
        foreach ($attributes as $attribute => $rules) {
            $value = request($attribute);
            $values[$attribute] = $value;
            $attribute_validate = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;

            foreach (explode('|', $rules) as $rule) {
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.email'));
                } elseif ($rule == 'required' && (is_null($value) || empty($value))) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.required'));
                } elseif ($rule == 'integer' && !filter_var((int)$value ,FILTER_VALIDATE_INT)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.integer'));
                } elseif ($rule == 'string' && !is_string($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.string'));
                }elseif($rule == 'numeric'&& !is_numeric($value)){
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.numeric'));
                }
            }

            if (!empty($attribute_validate) && is_array($attribute_validate) && count($attribute_validate) > 0) {
                $validations[$attribute] = $attribute_validate;
            }
        }
            if( count($validations) > 0 ){
                if($http_header =='redirect'){
                    session('errors',json_encode($validations));
                    session('old',json_encode($values));
                    redirect('/');
                }elseif($http_header =='api'){
                    return json_encode($validations,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
                }
            }else{
                return $values;
            }
        }
    }


if (!function_exists('any_errors')) {
    function any_errors($offset = null) {
        $array = json_decode(session('errors'), true);
        if (isset($array[$offset]) && !is_null($offset)) {
            $text = $array[$offset];
            session_flash('errors');
            return is_array($text) ? $text : [];
        } elseif (!empty($array) && count($array) > 0) {
            return $array;
        } else {
            return [];
        }
    }
}

if (!function_exists('all_errors')) {
    function all_errors() {
        $all_errors = [];
        foreach (any_errors() as $errors) {
            foreach ($errors as $error) {
                $all_errors[] = $error;
            }
        }
        return $all_errors;
    }
}

if (!function_exists('get_error')) {
    function get_error($offset) {
        $errors = any_errors($offset);
        if (empty($errors)) {
            return null;
        }
        $error = '<ul>';
        foreach ($errors as $error_string) {
            if (is_string($error_string)) {
                $error .= '<li>' . $error_string . '</li>';
            }
        }
        $error .= '</ul>';
        return $error;
    }
}

if(!function_exists('end_errors')){
    function end_errors(){
        session_flash('errors');
    }
}

if (!function_exists('old')) {
    function old($request){
        $old_values = json_decode(session('old'),true);
        if(is_array($old_values) && !empty($old_values) && in_array($request , array_keys($old_values))){
            return $old_values[$request];
        }else{
            return '';
        }
    }
}
