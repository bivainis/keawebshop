<?php
session_start();

// todo: check if admin and loggedin

require_once '../config.php';

$errors = array();
$data = array();

if (isset(
	$_POST['product_name'],
	$_POST['product_price'],
	$_POST['product_description'],
	$_POST['product_quantity'])) {

	$name = test_input($_POST['product_name']);
	$price = test_input($_POST['product_price']);
	$description = test_input($_POST['product_description']);
	$quantity = test_input($_POST['product_quantity']);
	$image = test_input($_POST['product_image']) ? test_input($_POST['product_image']) : 'http://placekitten.com/500/500';
}

function test_input($input = ''){

	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

try {
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
}

$query = 'insert into products (
		product_name,
		product_price,
		product_description,
		product_image,
		product_quantity )
	values (
		:name,
		:price,
		:description,
		:image,
		:quantity)';

$stmt = $dbh->prepare($query);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':price', $price);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':image', $image);
$stmt->bindValue(':quantity', $quantity);
$stmt->execute();

if($stmt->rowCount() == 1){
	$data['success'] = true;
	$data['message'] = 'Success!';
} else {
	$data['success'] = false;
	$data['message'] = 'Product adding failed, please try again';
}

echo json_encode($data);