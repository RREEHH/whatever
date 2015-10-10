<?php
	require_once("functions.php");
	// kui kasutaja ei ole sisse logitud
	// siis suunan data.php lehele
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
	}
	
	// kasutaja tahab välja logida
	if(isset($_GET["logout"])){
		// kustutame kõik session muutujad ja peateme sessiooni
		session_destroy();
		
		header("Location: login.php");
	}
	
?>
<?php
	$page_title = "Minu konto";
	$page_file_name = "data.php";
?>

Tere, <?php echo $_SESSION["logged_in_user_email"] ?><br>
<a href="?logout">Logi valja</a><br>
Sinu id on <?php echo $_SESSION["logged_in_user_id"] ?>


