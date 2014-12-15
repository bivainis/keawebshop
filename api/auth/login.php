<?php

$errors = array();
$data = array();

$email = $password = '';

$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

function test_input($input){

	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

// validate and set errors
if(empty($email)){
	$errors['email'] = 'Email is required';
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors['email'] = "Invalid email format";
}
if(empty($password)){
	$errors['password'] = 'Password is required';
}
if(strlen($password) < 6){
	$errors['password'] = 'Password needs to have at least 6 characters';
}

// store errors
if(!empty($errors)){
	$data['success'] = false;
	$data['errors'] = $errors;
} else {
	$data['success'] = true;
	$data['message'] = 'Success!';
}

// return errors json
echo json_encode($data);