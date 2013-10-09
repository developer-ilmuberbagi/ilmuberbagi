<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/devs', 'getdevs');

$app->run();

function getdevs() {
	$sql = "select * FROM sobat WHERE role='volunteer' ORDER BY nama";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$devs = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($devs);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="your_root";
	$dbpass="your_pass";
	$dbname="your_db";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>