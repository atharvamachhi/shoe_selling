<?php
session_start();
include("header.php");
include("connect.php");


?>
<script type="text/javascript">
	function validation()
	{
		
		
		
		if(form1.txtadd.value=="")
		{
			alert("Please Enter Your Delievery  Address");
			form1.txtadd.focus();
			return false;
		}
	
		
		
		var v = /^[0-9]+$/
		if(form1.txtmno.value=="")
		{
			alert("Please Enter Your Delievery Mobile No");
			form1.txtmno.focus();
			return false;
		}else if(form1.txtmno.value.length!=10)
		{
			alert("Please Enter Your Delievery Mobile No 10 Digit Long");
			form1.txtmno.focus();
			return false;
		}
		else{
			if(!v.test(form1.txtmno.value))
			{
				alert("Please Enter Only Digits in Your Delievery Mobile No");
				form1.txtmno.focus();
				return false;
			}
		}
		
		
	
	}
</script>
<?php
if(isset($_POST['btnplaced']))
{
	
	$add=$_POST['txtadd'];
	$mno=$_POST['txtmno'];
	$odate=date("Y-m-d");
	$cartid=$_SESSION['cartid'];
	$custid=$_SESSION['custid'];
	
	
	$res1=mysqli_query($conn,"select sum(qty*price) from cart_detail where cart_id='$cartid'");
	$r1=mysqli_fetch_array($res1);
	$totamt=$r1[0];
	
	$res2=mysqli_query($conn,"select max(order_id) from order_detail");
	$ordid=0;
	while($r2=mysqli_fetch_array($res2))
	{
		$ordid=$r2[0];
	}
	$ordid++;
		
	$query="insert into order_detail values('$ordid','$odate','$cartid','$custid','$add','$mno','$totamt')";
	if(mysqli_query($conn,$query))
	{	
		unset($_SESSION['cartid']);
		echo "<script type='text/javascript'>";
		echo "alert('Your Order Placed Succesfully');";
		echo "window.location.href='order_detail.php';";
		echo "</script>";
	}
	
	
}
?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Checkout Form</h1>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/regis1.jpg" alt="">
						<div class="hover">
							
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>CHECK OUT FORM</h3>
						<form class="row login_form" method="post" name="form1" id="contactForm">
							
							<div class="col-md-12 form-group">
								<textarea class="form-control"  name="txtadd" placeholder="Delievery Address" ></textarea>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtmno" placeholder="Delievery Mobile No" >
							</div>
							
							<div class="col-md-12 form-group">
								<div class="creat_account">
								
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="PLACED ORDER" name="btnplaced" class="primary-btn" onclick="return validation();">PLACED YOUR ORDER</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	

<?php
include("footer.php")
?>