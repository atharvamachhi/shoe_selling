<?php
session_start();
include("header.php");
include("connect.php");
?>
<script type="text/javascript">
	function validation()
	{
		var v = /^[a-zA-Z ]+$/
		if(form1.txtname.value=="")
		{
			alert("Please Enter Your Name");
			form1.txtname.focus();
			return false;
		}else{
			if(!v.test(form1.txtname.value))
			{
				alert("Please Enter Only Alphabets in Your Name");
				form1.txtname.focus();
				return false;
			}
		}
		if(form1.txtadd.value=="")
		{
			alert("Please Enter Your Address");
			form1.txtadd.focus();
			return false;
		}
		if(form1.txtcity.value=="")
		{
			alert("Please Enter Your City Name");
			form1.txtcity.focus();
			return false;
		}else{
			if(!v.test(form1.txtcity.value))
			{
				alert("Please Enter Only Alphabets in Your City Name");
				form1.txtcity.focus();
				return false;
			}
		}
		var v = /^[0-9]+$/
		if(form1.txtmno.value=="")
		{
			alert("Please Enter Your Mobile No");
			form1.txtmno.focus();
			return false;
		}else if(form1.txtmno.value.length!=10)
		{
			alert("Please Enter Your Mobile No 10 Digit Long");
			form1.txtmno.focus();
			return false;
		}
		else{
			if(!v.test(form1.txtmno.value))
			{
				alert("Please Enter Only Digits in Your Mobile No");
				form1.txtmno.focus();
				return false;
			}
		}
		var v = /^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]+\.([a-zA-Z]{2,4})+$/
		if(form1.txtemail.value=="")
		{
			alert("Please Enter Your Email ID");
			form1.txtemail.focus();
			return false;
		}else{
			if(!v.test(form1.txtemail.value))
			{
				alert("Please Enter Valid Email ID");
				form1.txtemail.focus();
				return false;
			}
		}
		if(form1.txtpwd.value=="")
		{
			alert("Please Enter Your Password");
			form1.txtpwd.focus();
			return false;
		}else if(form1.txtpwd.value.length<6)
		{
			alert("Please Enter Your Password More than 6 character");
			form1.txtpwd.focus();
			return false;
		}else if(form1.txtpwd.value.length>10)
		{
			alert("Please Enter Your Password Less than 10 character");
			form1.txtpwd.focus();
			return false;
		}
	}
</script>
<?php
if(isset($_POST['btncreate']))
{
	$name=$_POST['txtname'];
	$add=$_POST['txtadd'];
	$city=$_POST['txtcity'];
	$mno=$_POST['txtmno'];
	$email=$_POST['txtemail'];
	$pwd=$_POST['txtpwd'];
	$res1=mysqli_query($conn,"select * from cust_detail where email_id='$email'");
	if(mysqli_num_rows($res1)>0)
	{
		echo "<script type='text/javascript'>";
		echo "alert('Email Id Already Exists');";
		echo "window.location.href='registration.php';";
		echo "</script>";
	}else{
		$res2=mysqli_query($conn,"select max(cust_id) from cust_detail");
		$custid=0;
		while($r2=mysqli_fetch_array($res2))
		{
			$custid=$r2[0];
		}
		$custid++;
		$query="insert into cust_detail values('$custid','$name','$add','$city','$mno','$email','$pwd')";
		if(mysqli_query($conn,$query))
		{	
			echo "<script type='text/javascript'>";
			echo "alert('Customer Registration Succesfully');";
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
					<h1>Register</h1>
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
						<h3>CREATE AN ACCOUNT</h3>
						<form class="row login_form" method="post" name="form1" id="contactForm">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtname" placeholder="Name" >
							</div>
							<div class="col-md-12 form-group">
								<textarea class="form-control"  name="txtadd" placeholder="Address" ></textarea>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtcity" placeholder="City" >
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtmno" placeholder="Mobile No" >
							</div>
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
								<button type="submit" value="CREATE AN ACCOUNT" name="btncreate" class="primary-btn" onclick="return validation();">CREATE AN ACCOUNT</button>
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