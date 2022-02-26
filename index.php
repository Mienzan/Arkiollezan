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
  <title>Log In</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

	<style>
	.section {
	position: relative;
	height: 100vh;
}

.section .section-center {
	position: absolute;
	top: 50%;
	left: 0;
	right: 0;
	-webkit-transform: translateY(-50%);
	transform: translateY(-50%);
}

#booking {
	font-family: 'Montserrat', sans-serif;
	background-image: url('pictures/ctu.jpg');
	background-size: cover;
	background-position: center;
}

#booking::before {
	content: '';
	position: absolute;
	left: 0;
	right: 0;
	bottom: 0;
	top: 0;
	background: rgba(47, 103, 177, 0.6);
}

.booking-form {
	background-color: #fff;
	padding: 50px 20px;
	-webkit-box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
	box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
	border-radius: 4px;
}

.booking-form .form-group {
	position: relative;
	margin-bottom: 30px;
	margin-top: 20px;
}

.booking-form .form-control {
	background-color: #ebecee;
	border-radius: 4px;
	border: none;
	height: 40px;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #3e485c;
	font-size: 14px;
}

.booking-form .form-control::-webkit-input-placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control:-ms-input-placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control::placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form input[type="date"].form-control:invalid {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form select.form-control {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}

.booking-form select.form-control+.select-arrow {
	position: absolute;
	right: 0px;
	bottom: 4px;
	width: 32px;
	line-height: 32px;
	height: 32px;
	text-align: center;
	pointer-events: none;
	color: rgba(62, 72, 92, 0.3);
	font-size: 14px;
}

.booking-form select.form-control+.select-arrow:after {
	content: '\279C';
	display: block;
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
}

.booking-form .form-label {
	display: inline-block;
	color: #3e485c;
	font-weight: 700;
	margin-bottom: 6px;
	margin-left: 7px;
}

.booking-form .submit-btn {
	display: inline-block;
	color: #fff;
	background-color: red;
	font-weight: 700;
	padding: 14px 30px;
	border-radius: 4px;
	border: none;
	-webkit-transition: 0.2s all;
	transition: 0.2s all;
}

.booking-form .submit-btn:hover,
.booking-form .submit-btn:focus {
	opacity: 0.9;
}

.booking-cta {
	margin-top: 100px;
	margin-bottom: 30px;
}

.booking-cta h3 {
	font-style: Calibre;
	font-size: 32px;
	text-transform: uppercase;
	color: #fff;
	font-weight: 700;
}

.booking-cta p {
	font-size: 16px;
	color: rgba(255, 255, 255, 0.8);
}
	</style>
		
</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">
							<h3>Cebu Technological University  Naga Extension Campus</h3>
 							<p> A Premier, Multidisciplinary, Technological University.
							</p>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-7">
						<div class="booking-form">
						<div class="text-center"><img src="pictures/ctulogo.png" height="30%" width="35%"> Log in to CTU Naga Clinic.</div>
							<form method="POST" action="#">
		<center>
		<! this is a php message error starts here !>	
		<br>
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
		</center>

								<div class="form-group">
									<span class="form-label">User Name</span>
									<input class="form-control" placeholder="Enter User Name" id="email" name="email" type="text"  required>
								</div>
								<div class="form-group">
									<span class="form-label">Password</span>
									<input class="form-control" placeholder="Enter Your Password" id="pass" name="password" type="password" value="" required>
								</div>
								<div class="form-btn">
									<button class="submit-btn" name="login">Log In</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>