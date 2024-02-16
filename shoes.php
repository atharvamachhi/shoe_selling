<?php
include("header.php");
include("connect.php");

if(isset($_POST['btnapply']))
{
	$ca=$_POST['selca'];
	$gender=$_POST['selgender'];
	$cid=$_REQUEST['cid'];
}

?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shoes Details</h1>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
						<?php
						$qur1=mysqli_query($conn,"select * from cat_master");
						while($q1=mysqli_fetch_array($qur1))
						{
						?>
						
								 <li class="main-nav-list child"><a href="shoes.php?cid=<?php echo $q1[0]; ?>"><?php echo $q1[1]; ?><span class="number"></span></a></li>
							

						<?php
						}
						?>
					</ul>
				</div>
			
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<form method="post">
				<div class="filter-bar d-flex flex-wrap align-items-center">
					
					<div class="sorting">
						<select name="selgender">
							<option value="MALE" <?php if(isset($gender)){echo $gender=='MALE'?'selected':'';}?>>MALE</option>
							<option value="FEMALE" <?php if(isset($gender)){echo $gender=='FEMALE'?'selected':'';}?>>FEMALE</option>
						</select>
						
					</div>
					<div class="sorting mr-auto">
						<select name="selca">
							<option value="1" <?php if(isset($ca)){echo $ca=='1'?'selected':'';}?>>CHILD</option>
							<option value="2" <?php if(isset($ca)){echo $ca=='2'?'selected':'';}?>>ADULT</option>

						
							
						</select>
					</div>
					
					<div>
						<input type="submit" name="btnapply" class="btn btn-secondary" value="APPLY FILTER">
					</div>
				</div>
				</form>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
					<?php
					if(isset($_REQUEST['cid']))
					{
						$cid1=$_REQUEST['cid'];
						if(empty($ca))
						{
							$res1=mysqli_query($conn,"select * from shoes_detail where cat_id='$cid1'");	
						}else{
							$res1=mysqli_query($conn,"select * from shoes_detail where cat_id='$cid1' and child_adult='$ca' and gender='$gender'");	
						}
						
					}else{
						if(empty($ca))
						{
							$res1=mysqli_query($conn,"select * from shoes_detail where cat_id='1'");	
						}else{
							$res1=mysqli_query($conn,"select * from shoes_detail where cat_id='1' and child_adult='$ca' and gender='$gender'");	
						}
					}
					if(mysqli_num_rows($res1)>0)
					{
						while($r1=mysqli_fetch_array($res1))
						{
					?>
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="<?php echo $r1[7]; ?>" style="width:255px; height:209px;"alt="">
								<div class="product-details">
									<h6><?php echo $r1[1]; ?></h6>
									<div class="price">
										<h6>&#8377; <?php echo $r1[4]; ?></h6>
										<h6 class="l-through">&#8377; <?php echo $r1[4]+50; ?></h6>
									</div>
									<div class="prd-bottom">

										<a href="shoes_detail.php?sid=<?php echo $r1[0]; ?>" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										
										
										
									</div>
								</div>
							</div>
						</div>
					<?php
						}
					}else{
						echo "<h2>No Shoes Found</h2>";
					}
					?>
					</div>
				</section>
				<!-- End Best Seller -->
				
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>


<?php
include("footer.php")
?>