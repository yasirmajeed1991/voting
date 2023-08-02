<?php
include('../config.php');
error_reporting(0);
session_start();
//FUNCTION FOR CHECKING TEXT INPUT  
									  function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
								$email=$password='';
								$emailErr=$passwordErr='';
							if($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								//POSTED RECORD
								//Validation For USER Form
									$email=$password='';
									$emailErr=$passwordErr='';
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
									if (empty($_POST["password"]) || empty($_POST["password"])) 
									{
										$passwordErr = "Password is required";
									}
									else
									{
											if ((strlen($password) <4) || (strlen($password) > 20))
											{
												$passwordErr = "Password must be greater than 8 character and less than 20 ";	
											}
									}
								
									//CHECKING FOR ERRORS IF THERE IS NOT ANY ERROR THAN THE FORM SHOULD BE SUBMITTED
									if(empty($emailErr) && empty($passwordErr)) 
									{
										//CHECKING FOR RECORD IF USER EXISTED		
												$query			=	"select * from user_register where (email='$email' && password='$password') ";
												$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
												if(mysqli_num_rows($rs)	> 0)	
												{
														$row		=	mysqli_fetch_array($rs);
														if($row['role'] == 'admin')
														{
															$_SESSION['timestamp'] = time(); //set new timestamp
															$_SESSION['user_id']		=	$row['id'];
															header("location:index.php");
														}
														else
														{
															$message_Err= "You are not Allowed to Login";
														}
												}		
												else
												{
													 $message_Err  = "Invalid User Details if not a registered member <a href='register.php'>Click Here</a> for registration";
												}
									}
							}						


?>
<?php
include('includes/header.php'); 
?>




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
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
				<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
				<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
              </div>

                <form class="user" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                    <span><?php if(!empty($emailErr)){echo '<p class="span_error">'.$emailErr.'</p>';}?></span>
					</div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    <?php if(!empty($passwordErr)){echo '<p class="span_error">'.$passwordErr.'</p>';}?>
					</div>
            
                    <button type="submit" class="btn btn-primary btn-user btn-block"> Login </button>
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