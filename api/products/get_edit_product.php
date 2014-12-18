<?php
session_start();

require_once '../config.php';

$errors = array();
$data = array();
if(isset($_GET['id']) && !empty($_GET['id'])){
	$productId = $_GET['id'];
} else {
	$data['success'] = false;
	$data['message'] = 'Problem occured';
	die();
}

try {
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
}

$query = 'select * from products where product_id = :productId';

$stmt = $dbh->prepare($query);
$stmt->bindValue(':productId', $productId);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	$data[] = $row;
}

echo json_encode($data);