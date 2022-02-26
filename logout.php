<?php
session_start();
unset($_SESSION['active']);
unset($_SESSION['userf']);
session_destroy();
header("Location: index.php");
?>