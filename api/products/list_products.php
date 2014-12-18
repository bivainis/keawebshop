<?php
session_start();

require_once '../config.php';

$errors = array();
$data = array();

try {
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
}

if(isset($_POST['id']) && !empty($_POST['id'])){
	$productId = $_POST['id'];
	$query = 'select * from products where product_active=1 and product_id = :productId';
	$stmt = $dbh->prepare($query);
	$stmt->bindValue(':productId', $productId);
} else {
	$query = 'select * from products where product_active=1';
	$stmt = $dbh->prepare($query);
}

$stmt->execute();

$data = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	$data[] = $row;
}

echo json_encode(array('products'=>$data));