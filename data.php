<?php 
	// et saada ligi sessioonile
	require("functions.php");
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();	
	}
	
	
	//kas kasutaja tahab v�lja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	if (   isset($_POST["note"])  &&
	       isset($_POST["color"])  &&
	       !empty($_POST["note"])  &&
	       !empty($_POST["color"]) 
	 ){
	   
	   $note = cleanInput($_POST["note"]);
	   
	   saveNote($_POST["note"], $_POST["color"]);
	
	}
	
	$notes = getAllNotes();
	
	echo "<pre>";
	var_dump($notes);
	echo "</pre>";

	
	
	
?>


     
		<h2>m�rkmed</h2>
		
		<form method="POST">
			
			<label>m�rkus</label><br>
			<input name="note" type="text">
			
			<br><br>
			
			<label>v�rv</label><br>
			<input name="color" type="color">
						
			<br><br>
			
			<input type="submit">
		
		</form>

		<h2>arhiiv</h2>
		
<?php

    //iga liikme kohta massiivis
	foreach($notes as $n) {
		
		$style = 
		   "width:100px;
		   float:left;
		   min-height:100px;
		   border: 1px solid gray;
		   background-color: " .$n->noteColor.";";
		   
		  echo "<p style =' ".$style." '>".$n->note."</p>";
		
	}




?>
	
<h2 style="clear:both;">Tabel</h2>
<?php

    $html = "<table>";
    
	    $html .= "<tr>";
	       $html .= "<th>id</th>";
	       $html .= "<th>M�rkus</th>";
	       $html .= "<th>V�rv</th>";
	    $html .= "</tr>";
	
	
	foreach ($notes as $note) {
		$html .= "<tr>";
	       $html .= "<td>".$note->id."</td>";
	       $html .= "<td>".$note->note."</td>";
	       $html .= "<td>".$note->noteColor."</td>";
	    $html .= "</tr>";
				
	}

    $html .= "</table>";
	
	echo $html;
	
?>



<h1>Data</h1>
<p>
   TERE tulemast <?=$_SESSION["userEmail"];?>!
   <a href="?logout=1">Logi v�lja</a>
   
</p>












