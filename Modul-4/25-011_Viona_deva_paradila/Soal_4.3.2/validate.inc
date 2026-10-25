<?php
function checkRequired($field,$key) {
    return (!isset($field[$key]) && empty($field[$key]));
}
function validateName(&$errors, $field_list, $field_name){
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname(alfabet) 
    if (!isset($field_list[$field_name]) ||
    empty($field_list[$field_name]))
    $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
    $errors[$field_name] = 'invalid';

}

function validateEmails(&$errors, $field_list, $field_email){
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (checkRequired($field_list,$field_email)) {
        $errors[$field_email] = 'required';
    } else if (!preg_match($pattern, $field_list[$field_email])) {
        $errors[$field_email] = 'invalid';
    }
}

function validatepassword(&$errors, $field_list, $field_password){
    $pattern = "/^(?=.*\d).{8,}$/";
    if (checkRequired($field_list,$field_password)) {
        $errors[$field_password] = "required";
    }else if (!preg_match($pattern, $field_list[$field_password])) {
        $errors[$field_password] = "<br> Pastikan setidaknya ada satu angka <br> Kata sandi harus minimal 8 karakter ";
    }
}