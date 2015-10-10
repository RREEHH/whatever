<?php
	require_once("config.php");
	$database = "if15_hirvela";
	
	session_start();
	
	function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
	}
	
	function createUser($email, $hash){
		$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO testkasutaja (email, password) VALUES (?,?)");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->execute();
		echo "Kasutaja on loodud!";
		$stmt->close();
		$mysqli->close();
	}
	
	function addCarPlate($number, $color){
		$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT ")
		
	}
	
	
	function loginUser($email, $hash){
		$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM testkasutaja where email=? and password=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
		
			// tekitan sessiooni muutujad
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
		
			// suunan data.php lehele
			header("Location: data.php");
		
		} else {
		//ei leidnud
		echo "Email või parool on vale!";
		}
		$stmt->close();
		$mysqli->close();
	}
?>