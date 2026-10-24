<?php
function validateName(&$errors, $field_list, $field_name){
$pattern = "/^[a-zA-Z'-]+$/"; // format surname(alfabet) 
if (!isset($field_list[$field_name]) ||
empty($field_list[$field_name]))
$errors[$field_name] = 'required';
else if (!preg_match($pattern, $field_list[$field_name]))
$errors[$field_name] = 'invalid';
}
