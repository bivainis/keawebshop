<?php

session_start();

require_once '../config.php';

$errors = array();
$data = array();

$userId = $_SESSION['userid'];
try {
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
	echo $e->getMessage();
}

$query = 'update partners set partner_active = 0 where partner_id = :partnerId';

$stmt = $dbh->prepare($query);
$stmt->bindValue(':partnerId', $userId);
$stmt->execute();

if($stmt->rowCount() == 1){

	$data['success'] = true;
	$data['message'] = 'Your account was removed :(';

	// delete session once removed to prevent accessing site
	session_destroy();
} else {
	$data['success'] = false;
	$data['message'] = 'There was a problem removing your account.';
}

echo json_encode($data);