<?php
session_start();
	
// connect to database
$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));

    if (isset($_POST['register'])) 
{  
	                    $firstname=$_POST['firstname'];
                        $lastname=$_POST['lastname'];
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $confirm=$_POST['confirm'];
		
	
    if (!preg_match("/^[a-zA-Z]+(\s[A-Za-z]+)*$/", $firstname) || !preg_match("/^[a-zA-Z]+(\s[A-Za-z]+)*$/", $lastname))
    {
	       $_SESSION['message'] = "Lastname/Firstname invalid";
    }
    else
	{
	       $sql = "SELECT * FROM login WHERE email='$email'";
	       $result = mysqli_query($mysqli, $sql);
	       $resultCheck = mysqli_num_rows($result);	  
        if ($resultCheck > 0)
	    {
		   $_SESSION['message'] = "Email is already taken";
	    }

        else
	       if((strlen($password)<=5))
	       {
	    	$_SESSION['message'] = "Password must not less than 6 characters long";
           }
           else
              if ($password != $confirm)
                {
                   $_SESSION['message'] = "Passwords do not match";
                }
              else
                   {
			         $password = md5($password);
                     $sql = "INSERT INTO login(firstname, lastname, email, password, status) VALUES('$firstname', '$lastname', '$email', '$password', 'admin')";
			         mysqli_query($mysqli, $sql);
					 {
					  	        ?>
	        <script type="text/javascript">
            alert("Admin Added.");
            window.location = "admin.php";
            </script>
            <?php
            }?>
            <?php
                   }
				   
    }
}
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
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Charts">
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
   <?php
   $connection = mysqli_connect('localhost', 'root', '', 'capstone');
				 $sql = "SELECT * FROM login order by lastname asc";
			 $result = mysqli_query($connection,$sql);
    ?>
   
   
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Admin</li>
		<li class="ml-auto">
          <a href="admin.php">Admin</a>
         </li>
      </ol>
<?php
   $connection = mysqli_connect('localhost', 'root', '', 'capstone');
				 $sql = "SELECT * FROM login order by lastname asc";
			 $result = mysqli_query($connection,$sql);
?>	  




<div class="row">
<div class="col-md-6 offset-3">
        <h5 class="text-center">Add Administrator</h5>
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
	  <form method="POST" action="addadmin.php">
         <input type="hidden" id="id" class="form-control" value="<?php echo $id; ?>" >		
         <div class="row">
		 <div class="col-md-6"> 
		 <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required>
         </div>
		 </div>
		 <div class="col-md-6"> 
		 <div class="form-group">
            <label>Lastname</label>
            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name"required>
         </div>
		 </div>
         </div>
         <div class="form-group">
            <label>Username</label>
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter email" required>
         </div>
         <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
         </div>
         <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
         </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>
      </form>
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
