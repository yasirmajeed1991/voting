<!DOCTYPE html>
<html lang="en">
<head>
  <title>I DEY Vote</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('link.php'); ?>
  <style >
  .rd-navbar-toggle {
    display: inline-block;
    position: relative;
    width: 48px;
    height: 48px;
    line-height: 48px;
    cursor: pointer;
    color: black;
    background-color: black;
    border: none;
	
}
</style>

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
                        <h2> Make we Vote</h2>
                        <p> Tell us if you don kolet your PVC when you go kari vote abi you still neva kolet<br> am, if yu wan no how to vote, yu fit as us, we go tish everi </p>
                        <section>
                        	<a  href="register-vote.php" class="btn btn-lg btn-block button-border-color"> I get PVC to Vote </a>
                            <a  href="register-vote.php" class="btn btn-lg btn-block button-border-color"> I no get PVC to Vote </a>
                            <a  href="" class="btn btn-lg btn-block button-border-color"> How I go fit vote from my side </a>
                        </section>
                    </div>
            	</div>
            </div>
        </div>
    </div>
</div>

<!--Footer Start-->
<?php include('footer.php'); ?>
