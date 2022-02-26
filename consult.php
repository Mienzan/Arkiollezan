<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));


date_default_timezone_set('Asia/Manila');





$idnumber = '';
$medicine_id = '';
$complain = '';
$date = '';


if(isset($_POST['save1'])){
	$idnumber = $_POST['idnumber'];
	$medicine_id = $_POST['medicine_id'];
	$complain = $_POST['complain'];
	$date = $_POST['date'];
	
	
	
	if ($medicine_id) {
		
		
	
							foreach ((array) $medicine_id as $m) {
	


	$mysqli->query("INSERT INTO transaction(idnumber, medicine_id, complain, date)
	VALUES('$idnumber', '$m', '$complain', '$date')") or
	 die($mysqli->error);
	

	$_SESSION['message'] = "Record has been saved!";
}
	}
	
	
		$medicine_id = $_POST['medicine_id'];
						if ($medicine_id) {
							foreach ((array) $medicine_id as $m) {

                          $query= "UPDATE `medicines` SET available = available-quantity  WHERE medicine_id ='".mysqli_real_escape_string($mysqli,$m)."'";
								mysqli_query($mysqli,$query)or die (mysqli_error($mysqli));
	
							}
						}
}

?>		
						
				
    	<script type="text/javascript">
			alert("Successfully added.");
			window.location = "consultation.php";
		</script>