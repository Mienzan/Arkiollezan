<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));



$medicine_id = '';
$medicine_name = '';
$prescription = '';
$requested_date = '';
$expiration_date = '';
$quantity ='';
$available = '';

if(isset($_POST['save'])){

	$medicine_name = $_POST['medicine_name'];
	$prescription = $_POST['prescription'];
	$requested_date = $_POST['requested_date'];
    $expiration_date = $_POST['expiration_date'];
	$qty = $_POST['qty'];
	$quantity = $_POST['quantity'];
	$available = $_POST['available'];

    for($i=1;$i <= $quantity;$i++){
	$mysqli->query("INSERT INTO medicines(medicine_name, prescription, requested_date, expiration_date, quantity, available)
	VALUES('$medicine_name', '$prescription', '$requested_date', '$expiration_date', '$qty', '$available')") or
	 die($mysqli->error);
	}

 	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";


            ?>
	        <script type="text/javascript">
            alert("Medicine Added.");
            window.location = "inventory.php";
            </script>
            <?php
            }?>
            <?php

?>
<?php
if(!$_SESSION["active"]){
 header("Location: index.php");
}
else if($_SESSION["status"]!=='admin') {
header("Location: index.php");
}
if(isset($_SESSION['active'])){
  echo '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><img src="pictures/ctulogo.png" width="30" height="30" class="d-inline"> &nbspCebu Technological University</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="home.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Consultation">
          <a class="nav-link" href="consultation.php">
            <i class="fa fa-fw fa-plus-square"></i>
            <span class="nav-link-text">Consultation</span>
          </a>
        </li>
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Inventory">
          <a class="nav-link" href="inventory.php">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Inventory</span>
          </a>
        </li>    
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Administrator">
          <a class="nav-link" href="admin.php">
            <i class="fa fa-fw fa-user-circle"></i>
            <span class="nav-link-text">Admin</span>
          </a>
        </li>    
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Log Out">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>    		
      </ul>
	  
	  
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
	  
	  
      <ul class="navbar-nav ml-auto">		        
        <li class="nav-item">
           <a class="navbar-brand" href="#">Welcome to CTU-Naga Clinic!</a>
        </li>
      </ul>
    </div>
  </nav>
  ';
}
?>	  
 	<?php
   $connection = mysqli_connect('localhost', 'root', '', 'capstone');
			 $query = "SELECT `medicine_id`,`medicine_name`,`prescription`, `requested_date`, `expiration_date`, SUM(`quantity`) as 'quantity' , SUM(`available`) as 'available' FROM `medicines` GROUP BY `medicine_name`";
			 $result = mysqli_query($connection,$query);
   ?>
   
   
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Medicine</li>
		<li class="ml-auto">
          <a href="inventory.php">Back</a>
         </li>
      </ol>





<div class="card text-center">
  <div class="card-header">
Add Medicine
  </div>
<! this is a php message error starts here !>	
			<?php
           if (isset($_SESSION['message'])): ?>
           <div class="text-danger">
           <?php  
           echo $_SESSION['message'];
           unset($_SESSION['message']);
           ?>
           </div>
           <?php endif ?>
<! this is a php message error ends here !>	
<div class="card-body">
<small>
<form role="form" method="post" action="addmedicine.php">
<div class="row">

<script type="text/javascript">
function showfield(name){
  if(name=='Other')document.getElementById('div1').innerHTML='Other: <input class="form-control" type="text" name="medicine_name" required/>';
  else document.getElementById('div1').innerHTML='';
}
</script>	

	
      <div class="col-md-4">  
   	  <div style="float:left">Medicine name</div>
      <div class="form-group">
	    <select class="form-control" name="medicine_name" onchange="showfield(this.options[this.selectedIndex].value)" required>
                            <option value="">Please select in the list...</option>
                                <option>Paracetamol</option>
                                <option>Biogesic</option>
								<option>Neozip</option>
								<option>Flanax</option>
								<option>Rexidol</option>
								<option>Kremil-S</option>
								<option>Amoxicillin</option>
								<option>Mefenamic</option>
                                <option value="Other">Others...</option>
        </select>
      <div id="div1"></div>
	  </div>
	  </div>
   
      <div class="col-md-4">  
   	  <div style="float:left">Quantity</div>
      <div class="form-group">
	    <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
	  </div>
	  </div>
	  
	  <div class="form-group">
         <input type="hidden" hidden value="1" placeholder="Quantity" name="qty" required>
      </div> 
      <div class="form-group">
         <input type="hidden" hidden value="1" placeholder="Onhand" name="available" required>
      </div> 
	  
	  
 <div class="col-md-4">  
   	  <div style="float:left">Prescription</div>
      <div class="form-group">
	    <input type="text" name="prescription" class="form-control" placeholder="Prescription" required>
	  </div>
	  </div>
</div>


<div class="row">     
      <div class="col-md-6">  
   	  <div style="float:left">Requested date</div>
      <div class="form-group">
	    <input type="date" name="requested_date" class="form-control" placeholder="Requested Date" required>
	  </div>
	  </div>
	  
	  
      <div class="col-md-6">  
   	  <div style="float:left">Expiry date</div>
      <div class="form-group">
	    <input type="date" name="expiration_date" class="form-control" placeholder="Expiration Date" required>
	  </div>
	  </div>
	  
      
</div>

<div class="form-group pull-right">
   <button type="submit" class="btn btn-primary" name="save">Save</button>
   <button type="reset" class="btn btn-default">Clear Entry</button>
</div>	
</form>
</small>
</div>
</div>



















<?php
   
   function pre_r( $array ) {
     echo '<pre>';
	 print_r($array);
	 echo '</pre>';
 }


?>
    </div>
	</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © De Jesus D. 2021</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
     <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
</body>
</html>
