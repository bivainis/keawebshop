<?php

require_once 'config.php';

function generateJSON($dbh){
	$query = 'select product_id, product_name, product_description, product_image, product_price from products';

	$stmt = $dbh->prepare($query);
	$stmt->execute();

	$sXml = '<?xml version="1.0" encoding="UTF-8" ?>
				<products>';

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$toJSON[] = $row;

		$sId = $row['product_id'];
		$sName = $row['product_name'];
		$sPrice = $row['product_price'];
		$sDesc = $row['product_description'];
		$sPathToImage = $row['product_image'];
		$sXml .= "<product>
			<id>".$sId."</id>
			<name>".$sName."</name>
			<price>".$sPrice."</price>
			<price>".$sDesc."</price>
			<image>".$sPathToImage."</image>
		</product>";
	}

	$sXml .= "</products>";

	// save xml
	file_put_contents("../../products.xml", $sXml);

	$toReturn = array('products'=>$toJSON);

	// save json
	$fp = fopen('../../products.json', 'w+');
	fwrite($fp, json_encode($toReturn));
	fclose($fp);
}