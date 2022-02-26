<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));

?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));

 date_default_timezone_set('Asia/Manila');
 $date = date('F j, Y g:i:a  ');
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
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Consultation">
          <a class="nav-link" href="consultation.php">
            <i class="fa fa-fw fa-plus-square"></i>
            <span class="nav-link-text">Consultation</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
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

   
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Consultation</li>
		<li class="ml-auto">
          <a href="consultation.php">Back</a>
         </li>
      </ol>
<?php

$query = "SELECT idnumber, concat(idnumber,'-',firstname,\" \",lastname) FROM student";
$result = mysqli_query($mysqli,$query);


$query2 = "SELECT medicine_id,concat(medicine_name,\" \",expiration_date) FROM medicines where available = 1";
$result2 = mysqli_query($mysqli,$query2);
?>


<div class="card text-center">
  <div class="card-header">
Add Consultation
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
<form role="form" method="post" action="consult.php?action=add">
<div class="row">
 
 
      <div class="col-md-6">  
   	  <div style="float:left">ID number</div>
      <div class="form-group">
	  <select  name="idnumber" class="form-control" required>
			                  <option></option>
                              <?php while($row = mysqli_fetch_array($result)):; ?>
                              <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                              <?php endwhile; ?>
      </select>
	  </div>
	  </div>
  
      <div class="col-md-6">  
   	  <div style="float:left">Date</div>
      <div class="form-group">
	    <input class="form-control" name="date" value="<?php echo $date; ?>" required> 
	  </div>
	  </div>


	  
</div>


<div class="row">  

      

	  <script type="text/javascript">
function showfield(name){
  if(name=='Other')document.getElementById('div1').innerHTML='Other: <input class="form-control" type="text" name="complain" required/>';
  else document.getElementById('div1').innerHTML='';
}
</script>	  
      <div class="col-md-6">  
   	  <div style="float:left">Complain</div>
      <div class="form-group">
	  <select class="form-control" name="complain" onchange="showfield(this.options[this.selectedIndex].value)" required>
                            <option value="">Please select in the list...</option>
                                <option>Fever</option>
                                <option>Dysmenorrhea</option>
								<option>Head Ache</option>
								<option>Tooth Ache</option>
								<option>Stomache Ache</option>
								<option>Cough</option>
								<option>Runny Nose</option>
								<option>Sore Throat</option>
								<option>Hyperacidity</option>
                                <option value="Other">Others...</option>
      </select>
      <div id="div1"></div>
	  </div>
	  </div>
	  
	  
	  <div class="col-md-6">  
   	  <div style="float:left">Medicines</div>
	  <p class="text-primary">If you want more medicine crtl + click</p>
      <div class="form-group">
	  <select  name="medicine_id[]" multiple="multiple" class="form-control" required>
                              <?php while($row1 = mysqli_fetch_array($result2)):; ?>
                              <option value = "<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                              <?php endwhile; ?>
      </select>
	  </div>
	  </div>
      
</div>

<div class="form-group pull-right">
   <button type="submit" class="btn btn-primary" name="save1">Save</button>
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
