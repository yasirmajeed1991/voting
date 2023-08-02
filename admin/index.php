<?php
	include('../config.php');
	session_start();
	if(!isset($_SESSION['user_id'])){
		header('Location:login.php');
	}

?>




<?php
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    

    <!-- Earnings (Monthly) Card Example -->
    

    <!-- Earnings (Monthly) Card Example -->
    

    <!-- Pending Requests Card Example -->
  
  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>