<?php

// todo: hash password

require_once '../config.php';
require_once '../functions.php';


$errors = array();
$data = array();

$email = $password = '';

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userType'])){
	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	$userType = test_input($_POST['userType']);
}

// validate and set errors
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors['email'] = "Invalid email format";
}
if(empty($email)){
	$errors['email'] = 'Email is required';
}
if(strlen($password) < 6){
	$errors['password'] = 'Password needs to have at least 6 characters';
}
if(empty($password)){
	$errors['password'] = 'Password is required';
}

// store errors
if(!empty($errors)){

	$data['success'] = false;
	$data['errors'] = $errors;

} else {

	// unset errors
	unset($errors);

	// hash password
	$passHash = password_hash($password, PASSWORD_DEFAULT);

	try {
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}


	if($userType == 'partner'){
		$query = 'select partner_email from partners where partner_email = :email';
	} else if($userType == 'customer'){
		$query = 'select customer_email from customers where customer_email = :email';
	}

	$stmt = $dbh->prepare($query);
	$stmt->bindValue(':email', $email);
	$stmt->execute();

	if($stmt->rowCount() > 0){
		$data['success'] = false;
		$data['message'] = 'Email already exists';
	} else {

		if($userType == 'partner'){
			$query = 'insert into partners (partner_email, partner_password) values (:email, :password)';
		} elseif($userType == 'customer'){
			$query = 'insert into customers (customer_email, customer_password) values (:email, :password)';
		}

		$stmt = $dbh->prepare($query);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $passHash);
		$stmt->execute();

		if($stmt->rowCount() == 1){
			$data['success'] = true;
			$data['message'] = 'Success! Check your email';

			sendEmail($email, 'welcome');

		} else {
			$data['success'] = false;
			$data['message'] = 'Registration failed, try again';
		}
	}
}

// return errors json
echo json_encode($data);
