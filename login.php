<?php 
	
	
	require("functions.php");
	
	// kui kasutaja on sisseloginud, siis suuna data lehele
	if(isset ($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
		
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas on üldse olemas
	if (isset ($_POST["signupEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["signupEmail"])) {
			
			//oli tõesti tühi
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
				
			// kõik korras, email ei ole tühi ja on olemas
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	
	$signupPasswordError = "";
	$signupPassword = "";
	
	//kas on üldse olemas
	if (isset ($_POST["signupPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["signupPassword"])) {
			
			//oli tõesti tühi
			$signupPasswordError = "See väli on kohustuslik";
			
		} else {
			
			// oli midagi, ei olnud tühi
			
			// kas pikkus vähemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tm pikk";
				
			}
			
		}
		
	}
	
	//LOGIN
	
	$loginEmailError = "";
	$loginEmail = "";
	
		//kas on üldse olemas
	if (isset ($_POST["loginEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["loginEmail"])) {
			
			//oli tõesti tühi
			$loginEmailError = "See väli on kohustuslik";
			
		} else {
				
			// kõik korras, email ei ole tühi ja on olemas
			$loginEmail = $_POST["loginEmail"];
		}
		
	}
	
	
	$loginPasswordError = "";
	$loginPassword = "";
	
	//kas on üldse olemas
	if (isset ($_POST["loginPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["loginPassword"])) {
			
			//oli tõesti tühi
			$loginPasswordError = "See väli on kohustuslik";
			
		} else {
			
			// oli midagi, ei olnud tühi
			
			// kas pikkus vähemalt 8
			if (strlen ($_POST["loginPassword"]) < 8 ) {
				
				$loginPasswordError = "Parool peab olema vähemalt 8 tm pikk";
				
			}
			
		}
		
	}
	
	
	$loginPasswordError = "";
	$loginPassword = "";
	
	//kas on üldse olemas
	if (isset ($_POST["loginPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["loginPassword"])) {
			
			//oli tõesti tühi
			$loginPasswordError = "See väli on kohustuslik";
			
		} else {
			
			// oli midagi, ei olnud tühi
			
			// kas pikkus vähemalt 8
			if (strlen ($_POST["loginPassword"]) < 8 ) {
				
				$loginPasswordError = "Parool peab olema vähemalt 8 tm pikk";
				
			}
			
		}
		
	}
	
	
	
	$gender = "";
	if(isset($_POST["gender"])) {
		if(!empty($_POST["gender"])){
			
			//on olemas ja ei ole tühi
			$gender = $_POST["gender"];
		}
	}
	
	
	
	if ( isset($_POST["signupEmail"]) &&
		 isset($_POST["signupEmail"]) &&
	     $signupEmailError == "" &&
	     empty($signupPasswordError)
        )	
		{
		
		// ühtegi viga ei ole, kõik vajalik olemas
		echo "salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>"; 
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "räsi ".$password."<br>"; 
		
		//kutsun funktsiooni, et salvestada
		signup($signupEmail, $password);
	
	}
	$notice = "";
	
	// mõlemad login vormi väljad on täidetud
	if (   isset($_POST["loginEmail"])  &&
	       isset($_POST["loginPassword"])  &&
	       !empty($_POST["loginEmail"])  &&
	       !empty($_POST["loginPassword"]) 
	 ){
	   $notice = login($_POST["loginEmail"], $_POST["loginPassword"]);
	
	}
	
	
?>
<?php


	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	$cityError = "";
	
	//kas on üldse olemas?
	if(isset ($_POST["linn"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST["linn"])) {
			
			//oli tõesti tühi
			$cityError = "See väli on kohustuslik";
		
		}
	
		 else {
		
		// oli midagi, ei olnud tühi
		
		// pikkus kas pikkus vähemalt 8
		if (strlen ($_POST["linn"]) < 3 ) {
			
				$cityError = "linnanimi peab olema vähemalt 3 tähemärki pikk";
				
			}
		
		}	
	
	}
?>
<?php


		
	$phonenumberError = "";
	
	
	if(isset ($_POST["telefoninumber"])) {
		
		
		if (empty($_POST["telefoninumber"])) {
			
			
			$phonenumberError = "See väli on kohustuslik";
		
		} else {
		
		
			
			
			if (strlen ($_POST["telefoninumber"]) < 5 ) {
				
				$phonenumberError = "Telefoni number peab olema vähemalt 5 tähemärki pikk";
				
			}
		
		}	
	
	}
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		<p style="color:red;"><?php echo $notice; ?></p>
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email" value="<?=$loginEmail;?>" > <?php echo $loginEmailError; ?>
			
			<br><br>
			
			<label>Parool</label><br>
			<input placeholder="Parool" name="loginPassword" type="password"> <?php echo $loginPasswordError; ?>
						
			<br><br>
			
			<input type="submit">
		
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>" > <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input placeholder="Parool" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
						
			<br><br>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked > Mees<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male"> Mees<br>
			<?php } ?>
			
			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked > Naine<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female"> Naine<br>
			<?php } ?>
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked > Muu<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other"> Muu<br>
			<?php } ?>
			
			<input type="submit" value="Loo kasutaja">
		
		</form>

		  <h1>Lisa info</h1>
		
		<form method="POST">
				
			<input placeholder="linn" name="linn" type="linn"> <?php echo $cityError; ?>
		
			<br><br>			
			
			<input placeholder="telefoni number" name="telefoninumber" type="telefoninumber"> <?php echo $phonenumberError; ?>
		
			<br><br>
			
			

		
	</body>
</html>