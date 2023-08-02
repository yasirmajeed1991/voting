<?php include ('config.php'); 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>News</title>
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
        <div class="col-xs-12 col-md-6 col-lg-6">
			<?php include "navbar.php";?>
        	<div class="container">
            	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12 rightside">
								<h2 class="news_heading">News </h2>
								<div class="row blog_thumbs">
								<?php 
								
								$num_per_page=02;


								if(isset($_GET["page"]))
								{
									$page=$_GET["page"];
								}
								else
								{
									$page=1;
								}

								$start_from=($page-1)*02;
								
								
								
									$sql = "SELECT * FROM blog limit $start_from,$num_per_page";
									$rs = mysqli_query($conn, $sql);
									while($blog_data = mysqli_fetch_assoc($rs)){
										
										$string = strip_tags($blog_data['post_content_body']);
										if (strlen($string) > 150) 
										{
											// truncate string
											$stringCut = substr($string, 0, 150);
											$endPoint = strrpos($stringCut, ' ');
											//if the string doesn't contain any space then it will cut without word basis.
											$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
											
										}
								?>
								<div class="col-12">
									<div class="blog_post blog_style2">
										<div class="blog_img">
											<a href="">
												<img src="admin/<?php echo $blog_data['post_main_img']; ?>" alt="blog_small_img1" style="height: 12.2rem;">
											</a>
										</div>

										<div class="blog_content bg-white">
											<div class="blog_text">
												<h6 class="blog_title"><a href=""><?php echo $blog_data['post_title']; ?></a></h6>
												<ul class="list_none blog_meta">
													<li><a href="#"><i class="far fa-calendar"></i><?php echo $blog_data['date_created']; ?></a></li>
													
												</ul>
												<p><?php echo $string; ?></p>
												
											</div>
										</div>
									</div>
								</div>
									<?php } ?>
								<div class="col-12 mt-2 mt-md-4">
								
								<!--Pagination-->
				<?php 
        
                $pr_query = "select * from blog ";
                $pr_result = mysqli_query($conn,$pr_query);
                $total_record = mysqli_num_rows($pr_result );
                
                $total_page = ceil($total_record/$num_per_page); ?>
				<div class="col-12 mt-2 mt-md-4" style="bottom: 3rem">
                        <ul class="pagination pagination_style1 justify-content-center">
						<?php

								if($page>1)
								{
									echo "<li class='page-item'><a href='blog.php?page=".($page-1)."' class='page-link' tabindex='-1'><i class='fas fa-arrow-left'></i></a></li>";
								}

								if(isset($_GET['page'])){
									$get_page_to_active = $_GET['page'];
								}
								for($i=1;$i<$total_page;$i++)
								{
									echo "<li class='page-item active'><a href='blog.php?page=".$i."' class='page-link' >$i</a></li>";
								}
								
								if($i>$page)
								{
									echo "<li class='page-item'><a href='blog.php?page=".($page+1)."' class='page-link'><i class='fas fa-arrow-right'></i></a></li>";
								}
						
						?>
						</ul>
					</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!--Footer Start-->
<?php include('footer.php'); ?>
