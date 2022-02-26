<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));


$semester = '';
$notes = '';
$date = date("Y/m/d");
$status = '';
$idnumber = ($_GET['add']);



if(isset($_POST['save1'])){
	$idnumber = $_POST['idnumber'];
	$semester = $_POST['semester'];
	$notes = $_POST['notes'];
	$file_name = $_FILES["file_name"]["name"];

if(!empty($file_name)) {
   $mysqli->query("INSERT INTO othersfile(file_name, idnumber)
	VALUES('$file_name', '$idnumber')") or
	 die($mysqli->error);
}

	$mysqli->query("INSERT INTO othersmedical(idnumber, semester, notes, date, status)
	VALUES('$idnumber', '$semester', '$notes', '$date', 'passed')") or
	 die($mysqli->error);

    $_SESSION['message'] = "Medical Record has been saved!";
	$_SESSION['msg_type'] = "success";
	        ?>
	        <script type="text/javascript">
            alert("Medical Record Added as Passed.");
            window.history.go(-2);
            </script>
            <?php
            }?>
            <?php
if(isset($_POST['save2'])){
	$idnumber = $_POST['idnumber'];
	$semester = $_POST['semester'];
	$notes = $_POST['notes'];
	$file_name = $_FILES["file_name"]["name"];

if(!empty($file_name)) {
   $mysqli->query("INSERT INTO othersfile(file_name, idnumber)
	VALUES('$file_name', '$idnumber')") or
	 die($mysqli->error);
}

	$mysqli->query("INSERT INTO othersmedical(idnumber, semester, notes, date, status)
	VALUES('$idnumber', '$semester', '$notes', '$date', 'failed')") or
	 die($mysqli->error);

 	        ?>
	        <script type="text/javascript">
            alert("Medical Added as Failed.");
           window.history.go(-2);
            </script>
            <?php
            }?>
            <?php
if(isset($_POST['save3'])){
	$idnumber = $_POST['idnumber'];
	$semester = $_POST['semester'];
	$notes = $_POST['notes'];
	$file_name = $_FILES["file_name"]["name"];

if(!empty($file_name)) {
   $mysqli->query("INSERT INTO othersfile(file_name, idnumber)
	VALUES('$file_name', '$idnumber')") or
	 die($mysqli->error);
}
	

	$mysqli->query("INSERT INTO othersmedical(idnumber, semester, notes, date, status)
	VALUES('$idnumber', '$semester', '$notes', '$date', 'pending')") or
	 die($mysqli->error);

 	        ?>
	        <script type="text/javascript">
            alert("Medical Record Added as Pending.");
            window.history.go(-2);
            </script>
            <?php
            }?>
            <?php

?>





<?php
if(!$_SESSION["active"]){
 header("Location: login.php");
}
else if($_SESSION["status"]!=='admin') {
header("Location: login.php");
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
  <style>
.file-upload {
  background-color: #ffffff;
  margin: 0 auto;
  padding: 5px;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 5px;
  border: 4px dashed #1FB264;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #1FB264;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
</style>
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
        <li class="breadcrumb-item active">Add Medical</li>
		 <li class="ml-auto">
           <a href="#" onclick="goBack()">Back</a>
         </li>
      </ol>


<script>
function goBack() {
  window.history.back();
}
</script>

<form action="addothersmedical.php" role="form" method="POST" enctype="multipart/form-data"> 
	        <input type="hidden" name="idnumber" class="form-control" value="<?php echo $idnumber; ?>" placeholder="Enter ID Number" required>
            <div class="row">
               <div class="col-md-6 offset-md-3"">  
   	           <label class="font1"><b>Semester</b></label>
	           <div class="form-group">
               
                <select name="semester" class="form-control" required>
                <option> <?php
                $date2=date('Y', strtotime('+1 Years'));
                for($i=date('Y'); $i<$date2+7;$i++){
                echo'<option>'.'1st semester SY '.$i.'-'.($i+1).'</option>';
				echo'<option>'.'Summer of '.$i.'-'.($i+1).'</option>';
				echo'<option>'.'2nd Semester SY '.$i.'-'.($i+1).'</option>';
                }
                ?></option>         
               </select>
               </div>		 
              </div>		  
            </div>
			
	        <div class="row">
             <div class="col-md-6 offset-md-3">  
   	          <label class="font1"><b>Notes</b></label>
              <div class="form-group">
		      <textarea rows="3" name="notes" class="form-control" placeholder="Medical Notes"></textarea>
	          </div>
              </div>	  
            </div>
			
			
			
			<div class="row mb-3">
              <div class="col-md-6 offset-md-3">  
			  <label class="font1"><b>Upload a File</b></label>
                <div class="file-upload">
                  <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' name="file_name" onchange="readURL(this);" accept="image/*" />
                    <div class="drag-text">
                    <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content">
                  <img class="file-upload-image" src="#" alt="your image" />
                  <div class="image-title-wrap">
                  <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                  </div>
                  </div>
                </div>
		      </div>
		    </div>
			
		
			
			
			<div class="row mb-3">
              <div class="col-md-6 offset-md-3">  
              <button type="submit" class="btn btn-success" name="save1">Passed</button>
	          <button type="submit" class="btn btn-danger" name="save2">Failed</button>
	          <button type="submit" class="btn btn-warning" name="save3">Pending</button>
		      </div>
		    </div>
			
			

	
</form>


<script>
function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

</script>













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
