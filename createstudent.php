<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));


$update = false;
$idnumber = '';
$lastname = '';
$firstname = '';
$middlename = '';
$birthdate ='';
$gender = '';
$age = '';
$course_id = '';
$guardian ='';
$telephone ='';

if(isset($_POST['save'])){
	$idnumber = $_POST['idnumber'];
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$birthdate = $_POST['birthdate'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
    $course_id = $_POST['course_id'];
	$guardian=$_POST['guardian'];
	$telephone=$_POST['telephone'];

	$mysqli->query("INSERT INTO student(idnumber, lastname, firstname, middlename, birthdate, gender, age, course_id, guardian, telephone)
	VALUES('$idnumber', '$lastname', '$firstname', '$middlename', '$birthdate', '$gender', '$age', '$course_id', '$guardian', '$telephone')") or
	 die($mysqli->error);

 	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";


 	        ?>
	        <script type="text/javascript">
            alert("Student Added.");
            window.location = "student.php";
            </script>
            <?php
            }?>
            <?php
if (isset($_GET['delete'])){
	$idnumber = $_GET['delete'];
	$mysqli->query("DELETE FROM student WHERE idnumber=$idnumber") or die($mysqli->error());
	
	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	
 	        ?>
	        <script type="text/javascript">
            alert("Student Deleted.");
            window.location = "student.php";
            </script>
			
            <?php
            }?>
            <?php


if (isset($_GET['edit'])){
	$idnumber = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM student WHERE idnumber=$idnumber") or die($mysqli->error());
		
	  if ($result){
     	$row = $result->fetch_array();
		$idnumber = $row['idnumber'];
    	$lastname = $row['lastname'];
		$firstname = $row['firstname'];
		$middlename = $row['middlename'];
		$birthdate = $row['birthdate'];
		$gender = $row['gender'];
		$age = $row['age'];
		$course_id = $row['course_id'];
		$guardian = $row['guardian'];
		$telephone = $row['telephone'];
    }
	       
}
if (isset($_POST['update'])){

	    $idnumber = $_POST['idnumber'];
    	$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$birthdate = $_POST['birthdate'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		$course_id = $_POST['course_id'];
		$guardian = $_POST['guardian'];
		$telephone = $_POST['telephone'];

	
	$mysqli->query("UPDATE student SET idnumber='$idnumber', lastname='$lastname', firstname='$firstname', middlename='$middlename', birthdate='$birthdate', gender='$gender', age='$age', course_id='$course_id', guardian='$guardian', telephone='$telephone' WHERE idnumber=$idnumber") or
	die($mysqli->error);
	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "success";
 	        ?>
	        <script type="text/javascript">
            alert("Student Updated.");
            window.history.go(-2);
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="consultation.php">
            <i class="fa fa-fw fa-plus-square"></i>
            <span class="nav-link-text">Consultation</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="inventory.php">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Inventory</span>
          </a>
        </li>    
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="admin.php">
            <i class="fa fa-fw fa-user-circle"></i>
            <span class="nav-link-text">Admin</span>
          </a>
        </li>    
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
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
        <li class="breadcrumb-item active">Add Student</li>
		 <li class="ml-auto">
          <a href="#" onclick="goBack()">Back</a>
         </li>
      </ol>
<script>
function goBack() {
  window.history.back();
}
</script>


<div class="card text-center">
  <div class="card-header">
Add a Student Information
  </div>
  <div class="card-body">
<small>
<form action="createstudent.php" role="form" method="POST">
<div class="row">
	
      <div class="col-md-3">  
   	  <div style="float:left">ID number</div>
      <div class="form-group">
	    <input type="number" name="idnumber" class="form-control" value="<?php echo $idnumber; ?>" placeholder="Enter ID number" required>
	  </div>
      </div>
   
      <div class="col-md-3">  
   	  <div style="float:left">Last Name</div>
      <div class="form-group">
	    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="last name" required>
	  </div>
	  </div>

      <div class="col-md-3">  
   	  <div style="float:left">First Name</div>
      <div class="form-group">
	    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="first name" required>
	  </div>
      </div>
  
      <div class="col-md-3">  
   	  <div style="float:left">Middle Name</div>
      <div class="form-group">
	    <input type="text" name="middlename" class="form-control" value="<?php echo $middlename; ?>" placeholder="Middle name" required>
	  </div>
      </div>
	  
</div>	
	
<div class="row">     
      <div class="col-md-3">  
   	  <div style="float:left">Birthdate</div>
      <div class="form-group">
	    <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>" placeholder="birthdate" required>
	  </div>
	  </div>

      <div class="col-md-3">  
   	  <div style="float:left">Gender</div>
      <div class="form-group">		
        <select name="gender" class="form-control" required>
        <option><?php echo $gender; ?></option>
        <option>F</option>
        <option>M</option>
        </select>
      </div>
      </div>
	  
	  <div class="col-md-3">  
   	  <div style="float:left">Age</div>
      <div class="form-group">
	    <input type="number" name="age" class="form-control" value="<?php echo $age; ?>" placeholder="age" required>
	  </div>
	  </div>
	  
	  
  
      <div class="col-md-3">  
      <div style="float:left">Course/Yr/Section/Program</div>
	  <div class="form-group">
           <?php
           $link=mysqli_connect("localhost","root","","capstone");
           mysqli_select_db($link,"dropdown");  
           ?> 
         <select name="course_id" class="form-control" required>
		 
 		 <!-- If e-update ang course di-ari mugawas starts here-->
		 <?php
           $res=mysqli_query($link,"select * from course WHERE course_id=$course_id");
		   $divina=mysqli_fetch_array($res);
		 ?>	 
            <option value="<?php echo $divina['course_id']; ?>"> 
		           <?php echo $divina['course_name']; ?> 
				   <?php echo $divina['year_level']; ?>
                   <?php echo $divina['course_section']; ?>
				   <?php echo $divina['program']; ?>
		   </option>
		  <!-- If e-update ang course di-ari mugawas ends here-->
		   
		   
		  <!-- If mo choose ug course di-ari mugawas starts here-->
           <?php
           $res=mysqli_query($link,"select * from course order by course_name asc");
           while($row=mysqli_fetch_array($res))
           {
           ?>
		   <option value="<?php echo $row['course_id']; ?>"> 
		                  <?php echo $row ['course_name']; ?> 
						  <?php echo $row ['year_level']; ?>
						  <?php echo $row ['course_section']; ?>
						  <?php echo $row ['program']; ?>
		   </option> 
           <?php
           }
           ?>
		   <!-- If mo choose ug course di-ari mugawas ends here-->
         </select>	 
      </div>		 
      </div>	  
</div>

<div class="row">
     <div class="col-md-6">  
   	 <div style="float:left">Guardian's Full Name</div>
      <div class="form-group">
	    <input type="text" name="guardian" class="form-control" value="<?php echo $guardian; ?>" placeholder="Guardian" required>
	  </div>
	  </div>
	  
	  <div class="col-md-6">  
   	  <div style="float:left">Guardian's Contact Number</div>
      <div class="form-group">
	    <input type="number" name="telephone" class="form-control" value="<?php echo $telephone; ?>" placeholder="Contact Number" required>
	  </div>
	  </div>
</div>
<div class="form-group pull-right">
   <?php
   if ($update == true):
   ?>
   <button type="submit" class="btn btn-info" name="update">Update</button>
   <?php else: ?>
   <button type="submit" class="btn btn-primary" name="save">Save</button>
   <?php endif; ?>
</div>	
</form>
</small>
</div>
</div>









  





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
