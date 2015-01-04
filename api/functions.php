<?php

require_once 'config.php';

function test_input($input = ''){

	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

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

function sendEmail($toEmail, $type = null){

	require_once 'vendor/autoload.php';

	switch ($type) {

		case 'welcome':
		$subject = 'Welcome to KEA Webshop';
		$content = '<h2>Welcome to KEA Webshop. Happy purchasing!</h2>';
		break;

	}

	$transport = \Swift_SmtpTransport::newInstance(
		'mx1.hostinger.in',
		2525
	)
	->setUserName('info@keawebshop.wc.lt')
	->setPassword('');

	$swift = \Swift_Mailer::newInstance($transport);

	$message = \Swift_Message::NewInstance($subject)
	->setFrom(['info@keawebshop.wc.lt' => 'Info from KEA Webshop'])
	->setTo([$toEmail=>''])
	->setBody($content, 'text/html')
	->addPart(strip_tags($content), 'text/plain');

	$swift = $swift->send($message);
}
