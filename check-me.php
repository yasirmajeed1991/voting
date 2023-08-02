<?php
error_reporting(0);
include('config.php');
		function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//validation
		$email = $phone = '';
		$emailErr = $phoneErr = '';
		
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		//email
		if (empty($_REQUEST["email"])) 
			{
				$emailErr = "Email is required";
			} 
			else 
			{
				$email = test_input($_REQUEST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
				  $emailErr = "Invalid email format";
				}
			}
		//phone
			if(empty($_REQUEST['phone'])){
				$phoneErr = "Phone is Required";
			}else{
				$phone = $_REQUEST['phone'];
			}
			if(empty($emailErr) && empty($phoneErr)){
				$query			=	"select * from register_vote where (email='$email'&& mobile ='$phone') ";
				$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
				$row		    =	mysqli_fetch_array($rs);
				if($row>0)
					{
						$message_success = "Voter is already Exists";
						
					}
					else{
						
						$message_Err = "Voter doesn't exist, <a href='register-vote.php'>Register vote now</a>";
					}
			}
	}
		


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Check Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('link.php'); ?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!--Left Side-->
        <?php include ('rightside.php'); ?>
        <!--Right Side-->
        <div class="col-xs-12 col-md-12 col-lg-6">
			<?php include "navbar.php";?>
        	<div class="container">
            	<div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 rightside">
						<h2 class="check_me_title"> Check me </h2>
						<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
					<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
						<form method="post">
						  <div class="form-settings">
							<input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
							<span style="color: red;"><?php echo $emailErr ?></span>
						  </div>
						  <div class="form-settings-2">
							<input type="text" name="phone" class="form-control" id="" placeholder="Mobile">
							<span style="color: red;"><?php echo $phoneErr ?></span>
						  </div>
						  <button type="submit" class="btn btn-success btn-lg btn-block button-setting">Submit</button>
						</form>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!--Footer Start-->
<?php include('footer.php'); ?>
