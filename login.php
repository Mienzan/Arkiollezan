<?php
$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));
session_start();
if(isset($_SESSION["active"]) && $_SESSION["status"]=='admin'){
 header("Location: home.php");
}else{
?>
<?php
}

    if (isset($_POST['login'])) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		
		$email = $_POST['email'];
		$password = $_POST['password'];

  
  $mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));
  
  $query=mysqli_query($mysqli,"select * from `login` where email='$email' && password=MD5('$password')");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
    $_SESSION["userf"]=$row['firstname'];
    $_SESSION["userl"]=$row['lastname'];
	$_SESSION["status"]=$row['status'];
    $_SESSION["active"]=$row['firstname'];
    $_SESSION["active2"]=$row['lastname'];
  if ($_SESSION['status']=='admin'){
   // echo $Message;
   // include "home.php";
    ?>
    <script type="text/javascript">
      alert("Login Successful.");
      window.location = "home.php";
    </script>

    <?php
   }?>
   <?php
  
  if ($num_rows>0){
    $Message = "Login Successful!";
  }
  else{
  $Message = "Login Failed! User not found";
  $_SESSION['message']=$Message;
  unset($_SESSION['active']);
  unset($_SESSION['active2']);
  unset($_SESSION['userf']);
  unset($_SESSION['userl']);
  session_destroy();
     $_SESSION['message'] = "Email/Password Incorrect";
 
  }
  
  }
}

function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
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
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<style>
 .row{
 margin-top: 7%;
</style>
</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><img src="pictures/ctulogo.png" width="30" height="30" class="d-inline"> &nbspCebu Technological University</a>
    <div class="collapse navbar-collapse" id="navbarResponsive">  
      <ul class="navbar-nav ml-auto">		        
        <li class="nav-item">
           <a class="navbar-brand" href="#">Welcome to CTU-Naga Clinic!</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="container-fluid">
<div class="row">
    <div class="col-md-6">
		<div class="customDiv">
		    <img src="pictures/login.jpg" class="offset-1">
		</div>
    </div>
		  
    <div class="col-md-6 ">
		<div class="customDiv">
		<div class="form mx-auto">
		       <h4><b><center>Sign in</center></b></h4>
               <p><b>Welcome Back!</b></p>
		       <p class="text-black-50"> To keep connected with us please login with your personal
		       information by email and password. </p>
        <div class="card-body">
        <form method="POST" action="#">
				
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
		   
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" id="email" name="email" type="text"  required>
                    </div>
                    <div class="form-group">                   
                        <input class="form-control" placeholder="Password" id="pass" name="password" type="password" value="" required>
                    </div>
                        <hr/>
                    <div class="form-group">
                        <input type="checkbox" name="remember">
                        <label class="text-black-50" for="remember-me"> Remember me </label>
					   
                    </div>							 
	                <button type="submit" class="btn btn-success btn-block" name="login">Login</button> 
                </fieldset>
        </form>
				    <br>
                    
        </div>
        </div>
	    </div>
	</div>
</div>
 
 
<!-- Footer --> 
<footer class="page-footer font-small blue fixed-bottom" style="background-color: #e9ecef">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3"><small>© 2021 Copyright: De Jesus D.</small>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</div>
</body>
</html>
