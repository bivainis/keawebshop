<?php

require_once '../config.php';

$errors = array();
$data = array();

$email = $password = '';

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userType'])){
	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	$userType = test_input($_POST['userType']);
}

function test_input($input = ''){

	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
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
if(empty($userType)){
	$errors['userType'] = 'You must to choose login type';
}


// store errors
if(!empty($errors)){

	$data['success'] = false;
	$data['errors'] = $errors;

} else {

	// unset errors
	unset($errors);

	try {
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}

	if($userType == 'partner'){
		$query = 'select * from partners where partner_email=:email';
	} elseif ($userType == 'customer') {
		$query = 'select * from customers where customer_email=:email';
	}

	$stmt = $dbh->prepare($query);
	$stmt->bindValue(':email', $email);
	$stmt->execute();

	if($stmt->rowCount() == 1){

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$hash = '';

		if($userType == 'partner'){
			$hash = $row['partner_password'];
		} elseif ($userType == 'customer') {
			$hash = $row['customer_password'];
		}

		if (password_verify($password, $hash)) {

			$data['success'] = true;
			$data['message'] = 'Success!';
			session_start();
			$_SESSION['loggedin'] = true;

			// set user role in the session
			if($userType == 'partner'){
				$_SESSION['userid'] = $row['partner_id'];
				$_SESSION['user_role'] = $row['partner_type']; // 0 partner, 1 admin
			} elseif ($userType == 'customer') {
				$_SESSION['userid'] = $row['customer_id'];
				$_SESSION['user_role'] = 2; // customer
			}

		} else {
			$data['success'] = false;
			$data['message'] = 'Password doesn\'t match, try again';
		}

	} else {
		$data['success'] = false;
		$data['message'] = 'Email not found, try again';
	}
}

// return errors json
echo json_encode($data);