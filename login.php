<?php
session_start();
include("header.php");
include("connect.php");
if(isset($_POST['btnlogin']))
{
	$email=$_POST['txtemail'];
	$pwd=$_POST['txtpwd'];
	$res=mysqli_query($conn,"select * from admin_detail where email_id='$email' and pwd='$pwd'");
	if(mysqli_num_rows($res)>0)
	{
		echo "<script type='text/javascript'>";
		echo "alert('Admin Login Succesfully');";
		echo "window.location.href='admin_manage_cat.php';";
		echo "</script>";
	}else{
		$res2=mysqli_query($conn,"select * from cust_detail where email_id='$email' and pwd='$pwd'");
		if(mysqli_num_rows($res2)>0)
		{
			$r2=mysqli_fetch_array($res2);
			$_SESSION['custid']=$r2[0];
			if(isset($_SESSION['oid']))
			{
				unset($_SESSION['oid']);
				echo "<script type='text/javascript'>";
				echo "alert('Customer Login Succesfully');";
				echo "window.location.href='cust_checkout.php';";
				echo "</script>";
			}else{
				echo "<script type='text/javascript'>";
				echo "alert('Customer Login Succesfully');";
				echo "window.location.href='shoes.php';";
				echo "</script>";
			}
		}else{
			echo "<script type='text/javascript'>";
			echo "alert('Check Your Email Id or Password');";
			echo "window.location.href='login.php';";
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
					<h1>Login/Register</h1>
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
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="registration.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" method="post" id="contactForm">
							<div class="col-md-12 form-group">
								<input type="email" class="form-control"  name="txtemail" placeholder="Email ID" >
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" name="txtpwd" placeholder="Password">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="LOGIN" name="btnlogin" class="primary-btn">Log In</button>
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