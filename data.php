<?php 
	// et saada ligi sessioonile
	require("functions.php");
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();	
	}
	
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	if (   isset($_POST["automark"])  &&
	       isset($_POST["rendikestvus"])  &&
		   isset($_POST["värv"])  &&
	       !empty($_POST["automark"])  &&
	       !empty($_POST["rendikestvus"])  &&
		   !empty($_POST["värv"]) 
	 ){
	   
	   $note = cleanInput($_POST["automark"]);
	   
	   //Enam ei saa naiteks KickAssi scriptina jooksutada
		
		saveInfo($_POST["automark"], $_POST["rendikestvus"], $_POST["värv"]);
		
	}
	
	$notes = getAllNotes();
	
	//echo "<pre>";
	//var_dump($notes);
	//echo "</pre>";

	
	
	
?>

<h1>Data</h1>
<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logi välja</a>
</p>

     
<h2>Autode rent</h2>
		
		<form method="POST">
			
			<label>Auto mark</label><br>
			<input name="automark" type="text">
			
			<br><br>
			
			<label>Rendi kestvus</label><br>
			<input name="rendikestvus" type="text">
			
			<br><br>
			
			<label>värv</label><br>
			<input name="värv" type="text">
						
			<br><br>
			
			<input type="submit">
		
		</form>

		<h2>arhiiv</h2>
		
<?php

    //iga liikme kohta massiivis
	foreach($notes as $n) {
		
		//$style = 
		   //"width:100px;
		   //float:left;
		   //min-height:100px;
		  // border: 1px solid gray;
		   //background-color: " .$n->noteColor.";";
		   
		 // echo "<p style =' ".$style." '>".$n->note."</p>";
		
	}




?>
	
<h2 style="clear:both;">Tabel</h2>
<?php

    $html = "<table>";
    
	    $html .= "<tr>";
	       $html .= "<th>id</th>";
	       $html .= "<th>automark</th>";
		   $html .= "<th>rendikestvus</th>";
	       $html .= "<th>Värv</th>";
	    $html .= "</tr>";
	
	
	foreach ($notes as $note) {
		$html .= "<tr>";
	       $html .= "<td>".$note->id."</td>";
	       $html .= "<td>".$note->automark."</td>";
		   $html .= "<td>".$note->rendikestvus."</td>";
	       $html .= "<td>".$note->värv."</td>";
	    $html .= "</tr>";
				
	}

    $html .= "</table>";
	
	echo $html;
	
?>














