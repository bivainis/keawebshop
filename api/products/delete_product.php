<?php
session_start();

require_once '../config.php';
require_once '../functions.php';

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

generateJSON($dbh);

echo json_encode(array('products'=>$data));