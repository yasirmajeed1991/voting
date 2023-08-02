<?php
include('config.php');
error_reporting(0);

function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//validation
		$your_name = $email = $phone = $textarea ='';
		$your_nameErr = $emailErr = $phoneErr = $textareaErr = '';
		
		$your_name = $_REQUEST['your_name'];
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		$textarea = $_REQUEST['textarea'];
		//your_name
					if (empty($_REQUEST['your_name']))
					{
						$your_nameErr ="Name is Required";
					}
						else
					{
						$your_name = test_input($_REQUEST["your_name"]);
					
					}
		//Email
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
					if (empty($_REQUEST['phone']))
					{
						$phoneErr ="Phone is Required";
					}
						else
					{
						$phone = test_input($_REQUEST["phone"]);
					
					}
		//textarea
					if(empty ($_REQUEST['textarea'])){
						$textareaErr = 'Please Write something before submit';
					}else{
						$textarea = $_REQUEST['textarea'];
					}
					if(empty($your_nameErr) && empty($emailErr) && empty($phoneErr)){
						$sql = "INSERT INTO contact_us (your_name,email,phone,textarea) VALUES('$your_name','$email','$phone','$textarea')";
						$rs=	mysqli_query($conn,$sql) or die(mysqli_error());	
						$message_success = "Thanks For Contacting Us!";
					}
	}
		
?>									

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Us</title>
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
						<h2 class="contact_us_title"> Contact Us </h2>
						<div class="location-margin">
							<i class="fas fa-map-marker-alt"></i>
							<span>20 Holmeside,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sunderland,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Tyne and Wear,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  SR1 3JE</span>
						</div>
						<div class="location-margin">
							<i class="fas fa-mobile-alt"></i>
							<span> 0191 6498876 </span>
						</div>
						
						<div class="contact-form">
						
						<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
							<form method="post">
							  <div class="form-group">
								
								<input type="text" class="form-control" id="name" name="your_name" value="" placeholder="Name" required>
								<span><?php echo $your_nameErr ?></span>
							  </div>
							  <div class="form-group">
								
								<input type="email" class="form-control"id="name" name="email" value="" placeholder="Email" required>
								<span><?php echo $emailErr ?></span>
							  </div>
							  <div class="form-group">
								
								<input type="text" class="form-control" id="name" name="phone"  value="" placeholder="Phone" required>
								<span><?php echo $phoneErr ?></span>
							  </div>
							  <div class="form-group">
								
								<textarea class="form-control" name="textarea" id="exampleFormControlTextarea1" rows="3" required placeholder="Message"></textarea>
								<span><?php echo $textareaErr ?></span>
							  </div>
							  <button type="Submit" class="btn btn-success contacct-form-button">Submit </button>
							  
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!--Footer Start-->
<?php include('footer.php'); ?>
