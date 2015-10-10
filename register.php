<?php

	require_once("config.php");
	require_once("functions.php");
	
	if(isset($_SESSION["logged_in_user_id"])){
		header("Location: data.php");
	}
	
	// LOGIN.PHP
	$email_error = "";
	$password_repeat_error = "";
	$password_error = "";
	
	// muutujad andmebaasi v��rtuste jaoks
	$email = "";
	$password = "";
	$password_repeat = "";
	
	
	// kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//echo "keegi vajutas nuppu";
		
		//vajutas register nuppu
		
		if(isset($_POST["register"])) {
			
			if(empty($_POST["email"]))  {
				$email_error = "VEATEADE: Email on kohustuslik!";
			} else {
				$email = test_input($_POST["email"]);
			}
			if(empty($_POST["password"])) {
				$password_error = "VEATEADE: Parool on kohustuslik!";
			} else {
				//kui oleme siia j�udnud siis parool ei ole t�hi
				//kontrollin et olek v�hemalt 8 s�mbolit pikk
				if(strlen($_POST["password"]) < 8) {
					$password_error = "VEATEADE: Parool peab olema v�hemalt 8 t�hem�rki pikk!";
				}else {
					if($_POST["password"] != $_POST["password_repeat"]) {
						$password_repeat_error = "VEATEADE: Paroolid peavad kattuma!";
					}else{
						
						$password = test_input($_POST["password"]);
					}
					
				}
				
			}
			
			if($email_error == "" && $password_error == "" && $password_repeat_error == ""){
				$hash = hash("sha512", $password);
				createUser($email, $hash);
			}
		}
		
		
	}


	function test_input($data) {
		// v�tab �ra t�hikud, enterid, tabid
		$data = trim($data);
		// tagurpidi kaldkriipsud
		$data = stripslashes($data);
		// teeb htmli tekstiks
		$data = htmlspecialchars($data);
		return $data;
	}



?>
<?php
	$page_title = "Registreerimine";
	$page_file_name = "register.php";
?>
		<h2>Registreeri</h2>
			<form action="register.php" method="post">
				Email:<br>
				<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?><br>
				Parool:<br>
				<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?><br>
				Parool uuesti:<br>
				<input name="password_repeat" type="password" placeholder="Parool uuesti"> <?php echo $password_error; ?><br>
				<input name="register" type="submit" value="Registreeri"><br>
				<?php echo $password_repeat_error; ?>
			</form>
<a href="login.php">Kasutaja olemas? Logi sisse siin!</a>