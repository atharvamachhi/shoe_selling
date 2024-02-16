<?php
session_start();
include("header.php");
include("connect.php");


$sid=$_REQUEST['sid'];
$res1=mysqli_query($conn,"select * from shoes_detail where shoes_id='$sid'");
$r1=mysqli_fetch_array($res1);
$name1=$r1[1];
$catid1=$r1[2];
$desc1=$r1[3];
$price1=$r1[4];
$gender1=$r1[5];
$ca1=$r1[6];
$img1=$r1[7];


$res2=mysqli_query($conn,"select * from cat_master where cat_id='$catid1'");
$r2=mysqli_fetch_array($res2);
$cat1=$r2[1];


if(isset($_POST['btncart']))
{
	$qty=$_POST['txtqty'];
	$size1=$_POST['selsize'];
	if(isset($_SESSION['cartid']))
	{
		$res1=mysqli_query($conn,"select max(cart_d_id) from cart_detail");
		$cdid=0;
		while($r1=mysqli_fetch_array($res1))
		{
			$cdid=$r1[0];
		}
		$cdid++;
		
		$cartid=$_SESSION['cartid'];
		$query="insert into cart_detail values('$cdid','$cartid','$sid','$size1','$qty','$price1')";
		if(mysqli_query($conn,$query))
		{	
			
			echo "<script type='text/javascript'>";
			echo "alert('Shoes Added Into Cart Succesfully');";
			echo "window.location.href='shoes.php';";
			echo "</script>";
		}
	}else{
		
		$res1=mysqli_query($conn,"select max(cart_d_id) from cart_detail");
		$cdid=0;
		while($r1=mysqli_fetch_array($res1))
		{
			$cdid=$r1[0];
		}
		$cdid++;
		
		$res2=mysqli_query($conn,"select max(cart_id) from cart_detail");
		$cartid=0;
		while($r2=mysqli_fetch_array($res2))
		{
			$cartid=$r2[0];
		}
		$cartid++;
		
		$query="insert into cart_detail values('$cdid','$cartid','$sid','$size1','$qty','$price1')";
		if(mysqli_query($conn,$query))
		{	
			$_SESSION['cartid']=$cartid;
			echo "<script type='text/javascript'>";
			echo "alert('Shoes Added Into Cart Succesfully');";
			echo "window.location.href='shoes.php';";
			echo "</script>";
		}
	}
}

?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shoes Detail</h1>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					
						<div class="single-prd-item">
							<img class="img-fluid" src="<?php echo $img1; ?>" alt="">
						</div>
						
					
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>Name: <?php echo $name1; ?></h3>
						<h2>&#8377; <?php echo $price1; ?> /- </h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Category</span> : <?php echo $cat1; ?></a></li>
							
							<li><a href="#"><span>Child/Adult</span> : <?php if($ca1=="1"){ echo "CHILD"; }else{ echo "ADULT"; } ?></a></li>
							<li><a class="active" href="#"><span>Gender</span> : <?php echo $gender1; ?></a></li>
						</ul>
						<p><?php echo $desc1; ?></p>
						<form method="post">
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="txtqty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst < 5 ) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<br/>
						<div class="product_count" >
							
							
							<select name="selsize" id="size" style="position:relative;">
							<option value="0">Select Size</option>
							<?php
							$qur5=mysqli_query($conn,"select * from size_detail where shoes_id='$sid'");
							while($q5=mysqli_fetch_array($qur5))
							{
								?>
								<option><?php echo $q5[2]; ?></option>
								<?php
							}
							?>
							</select>
						</div>
						<div class="card_area d-flex align-items-center">
							<input type="submit" value="ADD TO CART" class="primary-btn" name="btncart">
							
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->


<?php
include("footer.php")
?>