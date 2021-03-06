<?php 
	// functions.php
    require("../../config.php");
	//et saab kasutada $_SESSION muutujaid
	//kõigis failides, mis on selle failiga seotud
	session_start();
	
	
	$database = "if16_jooshint_3";
	
	
	
	//var_dump($GLOBALS);
	
	function signup($email, $password) {
		
		$mysqli = new mysqli(
		
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"],  
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		
		);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password );
		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		
		");
		// asendan ?
		$stmt->bind_param("s", $email);
		
		// määran muutujad reale mis kätte saan
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		// ainult SLECTI'i puhul
		if ($stmt->fetch()) {
			
			// vähemalt üks rida tuli
			// kasutaja sisselogimise parool räsiks
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				// õnnestus 
				echo "Kasutaja ".$id." logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				
				exit();
				
			} else {
				$notice = "Vale parool!";
			}
			
		} else {
			// ei leitud ühtegi rida
			$notice = "Sellist emaili ei ole!";
		}
		
		return $notice;
	}
	
	
	function saveInfo($automark, $rendikestvus, $värv) {
		
		$mysqli = new mysqli(
		
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"],  
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		
		);
		$stmt = $mysqli->prepare("INSERT INTO colorNotes (automark, rendikestvus, värv) VALUES (?, ?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("sss", $automark, $rendikestvus, $värv);
		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	function getAllNotes() {
		
		$mysqli = new mysqli(
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		);
		
		$stmt = $mysqli->prepare("SELECT id, automark, rendikestvus, värv FROM colorNotes");
		
		$stmt->bind_result($id, $automark, $rendikestvus, $värv);
		
		$stmt->execute();
		
		
		$result = array();
		// tsükkel töötab seni kuni saab uue rea AB'i
		//nii mitu korda palju SELECT lausega tuli
		while ($stmt->fetch()) {
			//echo $note."<br>";
			
			$object = new StdClass();
			$object->id = $id;
			$object->automark = $automark;
			$object->rendikestvus = $rendikestvus;
			$object->värv = $värv;
			
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}
	
	
	function cleanInput ($input) {
		
		// "   tere tulemawst  "
		$input = trim($input);
		// "tere tulemast"
		
		//"tere \\tulemast"
		$input = stripslashes($input);
		// "tere tulemast"
		
		//"<"
		$input = htmlspecialchars($input);
		// "&lt;"
		
		return $input;
		
	}
	
	
	
	
	
?>

















