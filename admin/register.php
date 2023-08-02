<?php
include('../config.php');
session_start();
error_reporting(0);
 //FUNCTION FOR CHECKING TEXT INPUT  
									  function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
									
									$your_name = $email =$password ="";
									$your_nameErr=$emailErr= $passwordErr = "";
									if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								//POSTED RECORD
								//Validation For USER Form
								 	$your_name			= 	$_REQUEST['your_name'];
								 	$email				=	$_REQUEST['email'];
								  	$password			=	$_REQUEST['password'];
								
									//EMAIL
									if (empty($_POST["email"])) 
									{
										$emailErr = "Email is required";
									} 
									else 
									{
										$email = test_input($_POST["email"]);
										// check if e-mail address is well-formed
										if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
										{
										  $emailErr = "Invalid email format";
										}
									}
									//PASSWORD 
									if (empty($_POST["password"])) 
									{
										$passwordErr = "Password is required";
									}
									else
									{
											if ((strlen($password) <5) || (strlen($password) > 30))
											{
												$passwordErr = "Password must be greater than 5 character and less than 30 ";	
											}
									}
									//USERNAME
									if (empty($_POST["your_name"])) 
									{
									$your_nameErr = "Your Name is required";
									}
									else 
									{
										// check if name only contains letters and whitespace
										if (!preg_match("/^[a-zA-Z-' ]*$/",$your_name))
										{
										  $your_nameErr = "Your name Only Contains letters and numbers";
										}
										if ((strlen($your_name)< 5) || (strlen($your_name) > 15))
										{
											$your_nameErr = "Name Must be greater than 5 and less than 30 Characters";	
										}
										
									}
								
									//CHECKING FOR ERRORS IF THERE IS NOT ANY ERROR THAN THE FORM SHOULD BE SUBMITTED
									if(empty($emailErr) && empty($passwordErr) && empty($your_nameErr)) 
									{
										//CHECKING FOR RECORD IF USER ALREADY EXISTED		
										$query			=	"select * from user_register where email='$email' ";
										$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
										$row		    =	mysqli_fetch_array($rs);
										if($row>0)
										{
											$message_Err = "User Already Existed Please <a href='login.php'>Logged In!</a>";
										}
										else
										{
											$query = "INSERT INTO user_register (your_name,email,password,role) 
											values('$your_name','$email','$password','admin')";
											$rs=	mysqli_query($conn,$query) or die(mysqli_error());
												
											$message_success = "User Registered Successfully! Now<a href='login.php'> Login</a>";
										}
										
									}
							}				
?>

<?php 
//header including links//
include('includes/header.php'); ?>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register Here!</h1>
				<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
				<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
              </div>

                <form class="user" method="POST">

                    <div class="form-group">
					<label> Your Name </label>
                    <input type="text" name="your_name" class="form-control form-control-user" placeholder="Enter Your Name..." required>
                    <?php if(!empty($your_nameErr)){echo '<p class="error">'.$your_nameErr.'</p>';}?>
					</div>
					<div class="form-group">
					<label> Email </label>
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                    <?php if(!empty($emailErr)){echo '<p class="error">'.$emailErr.'</p>';}?>
					</div>
                    <div class="form-group">
					<label> Password </label>
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    <?php if(!empty($passwordErr)){echo '<p class="error">'.$passwordErr.'</p>';}?>	
					</div>
            
                    <button type="submit" class="btn btn-primary btn-user btn-block"> Signup </button>
                    <hr>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>