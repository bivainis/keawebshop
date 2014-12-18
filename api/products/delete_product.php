<?php
session_start();

require_once '../config.php';

$errors = array();
$data = array();

// catch id from DELETE request as an integer
$productId = array_pop(explode("id=", $_SERVER['REQUEST_URI'])) + 0;

try {
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
}

$query = 'delete from products where product_id=:productId';

$stmt = $dbh->prepare($query);
$stmt->bindValue(':productId', $productId);
$stmt->execute();

$data = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	$data[] = $row;
}

echo json_encode(array('products'=>$data));