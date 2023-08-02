 <?php 
 include('config.php');
//error_reporting(0);
include('link.php');
 ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-request-state-vote.php",
            data: { country : selectedCountry } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});
</script>
<script>
$(document).ready(function(){
    $("select.country1").change(function(){
        var selectedCountry = $(".country1 option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-request-state-vote.php",
            data: { country1 : selectedCountry } 
        }).done(function(data){
            $("#voteresult").html(data);
        });
    });
});
</script>
<div class="col-xs-12 col-md-12 col-lg-6 leftside">
            <div class="container">
                <div class="row">
					<!--Logo-->
						<div class="col-xs-9 col-md-9 logo-class">
							<a href="index.php">	<img src="img/logo.png" alt="logo"></a>	
						</div>

<div class="col">

<div class="rd-navbar-wrap">
          <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-sidebar" data-xl-device-layout="rd-navbar-sidebar" data-xxl-layout="rd-navbar-sidebar" data-xxl-device-layout="rd-navbar-sidebar" data-xl-stick-up-offset="400" data-xxl-stick-up-offset="400">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Brand-->
                 
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                </div>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Nav-->
                      <ul class="rd-navbar-nav">
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">Home</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="about-us.php">About Us</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="news.php">News</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="check-me.php">Check Us</a>
                      </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="contact-us.php">Contact Us</a>
                   <!--   </li>
                          <li class="rd-nav-item"><a class="rd-nav-link" href="register-vote.php">Register</a>
                      </li>-->
                    </ul>
                    
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>

</div>









				<?php
					$result=mysqli_query($conn,"SELECT count(id) as total from register_vote");
					$data=mysqli_fetch_assoc($result);
					 $count_voters = $data['total'];
					
				
				?>
					
					<!--Middle Portion-->
						<div class="col-xs-12 col-md-12 col-lg- imagecenter" >
						<img src="img/middle.jpg" alt="centerimage">
						</div>
						<div class="col-xs-12 col-md-12 col-lg-12 leftside-text">
						<p style="padding-top:30px;"> We need<span> 20,000,000</span> to elect a <span>Youth President</span> <br>
						<span>we</span> don ganda <span><?php echo $count_voters; ?></span>, oya enta,<br> make we vote
						</p>
						</div>
				
					<!--Form-->
					<div class="col-xs-6 col-md-5 col-lg-5 front-voters-form" >
						<p style="padding-top:20px;"> State</p>
						<select class="form-control form-control-sm country list-box" name="post_category" placeholder="State">
						  <option value="">Select Category</option>
						  <?php include "config.php";
													$result = mysqli_query($conn,"SELECT * FROM states"); 
													while($row = mysqli_fetch_array($result)) {
														$category_id = $row['id'];
														$category_name = $row['state'];
														if($post_category == $_REQUEST['post_category']){$selectedd="selected";}
													?>
							<option value="<?php echo $category_id;?>" <?php echo $selectedd?>><?php echo $category_name;?></option>
													<?php
													}
													?>							
						</select>
					</div>
					<div class="col-xs-6 col-md-5 col-lg-5 front-voters-form list-box action-item">
						<p style="padding-top:20px;"> Office</p>
						<select class="form-control form-control-sm list-boxx country1"  id="response" name="sub_category" required>
						  <option value="">City</option>
						</select>
					</div>



				</div>
				<div class="row justify-content-center " style="margin-top: 3rem;">
						<p id="voteresult">  </p>	

					</div>	
            </div>

        </div>
