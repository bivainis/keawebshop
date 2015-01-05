<?php
session_start();

require_once '../config.php';
require_once '../functions.php';

$errors = array();
$data = array();
var_dump($_POST);
die();
if (isset(
	$_POST['product_name'],
	$_POST['product_price'],
	$_POST['product_description'],
	$_POST['product_quantity'])) {

	$name = test_input($_POST['product_name']);
	$price = test_input($_POST['product_price']);
	$description = test_input($_POST['product_description']);
	$quantity = test_input($_POST['product_quantity']);
	$image = test_input($_POST['product_image']) ? test_input($_POST['product_image']) : '/assets/img/placeholder.png';
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
		product_quantity,
		product_partner_id)
	values (
		:name,
		:price,
		:description,
		:image,
		:quantity,
		:partnerId)';

$stmt = $dbh->prepare($query);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':price', $price);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':image', $image);
$stmt->bindValue(':quantity', $quantity);
$stmt->bindValue(':partnerId', $_SESSION['userid']);
$stmt->execute();

if($stmt->rowCount() == 1){
	$data['success'] = true;
	$data['message'] = 'Success!';

	generateJSON($dbh);
} else {
	$data['success'] = false;
	$data['message'] = 'Product adding failed, please try again';
}

echo json_encode($data);
