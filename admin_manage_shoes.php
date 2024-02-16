<?php
include("admin_header.php");
include("connect.php");
$res1=mysqli_query($conn,"select max(shoes_id) from shoes_detail");
$sid=0;
while($r1=mysqli_fetch_array($res1))
{
	$sid=$r1[0];
}
$sid++;
?>
<script type="text/javascript">
	function validation()
	{
		var v=/^[a-zA-Z ]+$/
		if(form1.txtname.value=="")
		{
			alert("Please Enter Shoes Name");
			form1.txtname.focus();
			return false;
		}else{
			if(!v.test(form1.txtname.value))
			{
				alert("Please Enter Only Alphabets in Your Shoes Name");
				form1.txtname.focus();
				return false;
			}
		}
		if(form1.selcat.value=="0")
		{
			alert("Please Select Category");
			form1.selcat.focus();
			return false;
		}
		if(form1.txtdesc.value=="")
		{
			alert("Please Enter Shoes Description");
			form1.txtdesc.focus();
			return false;
		}
		var v=/^[0-9]+$/
		if(form1.txtprice.value=="")
		{
			alert("Please Enter Shoes Price");
			form1.txtprice.focus();
			return false;
		}else if((parseInt(form1.txtprice.value))<=0)
		{
			alert("Please Enter Shoes Price Greater than 0");
			form1.txtprice.focus();
			return false;
		}else{
			if(!v.test(form1.txtprice.value))
			{
				alert("Please Enter Only Digits in Shoes Price");
				form1.txtprice.focus();
				return false;
			}
		}
		if(form1.selca.value=="0")
		{
			alert("Please Select Child/Adult");
			form1.selca.focus();
			return false;
		}
		if(form1.gender[0].checked==false)
		{
			if(form1.gender[1].checked==false)
			{
				alert("Please Select Gender")
				return false;
			}
		}
		var fname= document.getElementById("txtimg").value;
		var ext = fname.substr(fname.lastIndexOf(".")+1).toLowerCase().trim();
		if(document.getElementById("txtimg").value=="")
		{
			alert("Please Select Shoes Image");
			return false;
		}
		else
		{
			if(!(ext=="png" || ext=="jpeg" || ext=="jpg" || ext=="webp"))
			{
				alert("Please Select Shoes Image In Format Like jpg,jpeg,png or webp");
				return false;
			}
		}
	}
	function update_validation()
	{
		var v=/^[a-zA-Z ]+$/
		if(form1.txtname.value=="")
		{
			alert("Please Enter Shoes Name");
			form1.txtname.focus();
			return false;
		}else{
			if(!v.test(form1.txtname.value))
			{
				alert("Please Enter Only Alphabets in Your Shoes Name");
				form1.txtname.focus();
				return false;
			}
		}
		if(form1.selcat.value=="0")
		{
			alert("Please Select Category");
			form1.selcat.focus();
			return false;
		}
		if(form1.txtdesc.value=="")
		{
			alert("Please Enter Shoes Description");
			form1.txtdesc.focus();
			return false;
		}
		var v=/^[0-9]+$/
		if(form1.txtprice.value=="")
		{
			alert("Please Enter Shoes Price");
			form1.txtprice.focus();
			return false;
		}else if((parseInt(form1.txtprice.value))<=0)
		{
			alert("Please Enter Shoes Price Greater than 0");
			form1.txtprice.focus();
			return false;
		}else{
			if(!v.test(form1.txtprice.value))
			{
				alert("Please Enter Only Digits in Shoes Price");
				form1.txtprice.focus();
				return false;
			}
		}
		if(form1.selca.value=="0")
		{
			alert("Please Select Child/Adult");
			form1.selca.focus();
			return false;
		}
		if(form1.gender[0].checked==false)
		{
			if(form1.gender[1].checked==false)
			{
				alert("Please Select Gender")
				return false;
			}
		}
		var fname= document.getElementById("txtimg").value;
		var ext = fname.substr(fname.lastIndexOf(".")+1).toLowerCase().trim();
		if(document.getElementById("txtimg").value!="")
		{
			if(!(ext=="png" || ext=="jpeg" || ext=="jpg" || ext=="webp"))
			{
				alert("Please Select Shoes Image In Format Like jpg,jpeg,png or webp");
				return false;
			}
		}
	}
</script>
<?php
if(isset($_POST['btnsave']))
{
	$sid=$_POST['txtsid'];
	$name=$_POST['txtname'];
	$catid=$_POST['selcat'];
	$desc=$_POST['txtdesc'];
	$price=$_POST['txtprice'];
	$ca=$_POST['selca'];
	$gender=$_POST['gender'];
	$tmppath=$_FILES['txtimg']['tmp_name'];
	$ipath="shoes_img/S".$sid."_".rand(1000,9999).".png";
	$query="insert into shoes_detail values('$sid','$name','$catid','$desc','$price','$gender','$ca','$ipath')";
	if(mysqli_query($conn,$query))
	{
		move_uploaded_file($tmppath,$ipath);
		echo "<script type='text/javascript'>";
		echo "alert('Shoes Inserted Succesfully');";
		echo "window.location.href='admin_manage_shoes.php';";
		echo "</script>";
	}
}
if(isset($_REQUEST['esid']))
{
	$sid=$_REQUEST['esid'];
	$res2=mysqli_query($conn,"select * from shoes_detail where shoes_id='$sid'");
	$r2=mysqli_fetch_array($res2);
	$name1=$r2[1];
	$catid1=$r2[2];
	$desc1=$r2[3];
	$price1=$r2[4];
	$gender1=$r2[5];
	$ca1=$r2[6];
	$simg1=$r2[7];
}
if(isset($_POST['btnupdate']))
{
	$sid=$_POST['txtsid'];
	$name=$_POST['txtname'];
	$catid=$_POST['selcat'];
	$desc=$_POST['txtdesc'];
	$price=$_POST['txtprice'];
	$ca=$_POST['selca'];
	$gender=$_POST['gender'];	
	if($_FILES['txtimg']['size']>0)
	{
		$tmppath=$_FILES['txtimg']['tmp_name'];
		$ipath="shoes_img/S".$sid."_".rand(1000,9999).".png";
		move_uploaded_file($tmppath,$ipath);
		$query="update shoes_detail set shoes_name='$name',cat_id='$catid',description='$desc',price='$price',gender='$gender',child_adult='$ca',shoes_img='$ipath' where shoes_id='$sid'";
	}else{
		$query="update shoes_detail set shoes_name='$name',cat_id='$catid',description='$desc',price='$price',gender='$gender',child_adult='$ca' where shoes_id='$sid'";
	}
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Shoes Updated Succesfully');";
		echo "window.location.href='admin_manage_shoes.php';";
		echo "</script>";
	}
}
if(isset($_REQUEST['dsid']))
{
	$sid1=$_REQUEST['dsid'];
	$query="delete from shoes_detail where shoes_id='$sid1'";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Shoes Deleted Succesfully');";
		echo "window.location.href='admin_manage_shoes.php';";
		echo "</script>";
	}
}
?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Manage Shoes Detail</h1>
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
					<div class="login_form_inner">
						<form class="row login_form" method="post" name="form1" enctype="multipart/form-data">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtsid" placeholder="Shoes Id" value="<?php echo $sid; ?>" readonly>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="txtname" placeholder="Shoes Name" value="<?php echo $name1; ?>">
							</div>
							<div class="col-md-12 form-group">
								<select name="selcat" class="form-control xyz1">
								<option value="0">Select Category</option>
							<?php
							$res6=mysqli_query($conn,"select * from cat_master");
							while($r6=mysqli_fetch_array($res6))
							{
								?>
								<option value="<?php echo $r6[0]; ?>" <?php if($catid1==$r6[0]){ echo "selected=selected"; } ?>><?php echo $r6[1]; ?></option>
								<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-12 form-group">
								<textarea class="form-control"  name="txtdesc" placeholder="Description" ><?php echo $desc1; ?></textarea>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
								</div>
							</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner ">
							<div class="login_form">
							<div class="col-md-12 form-group">
								<input type="number" class="form-control"  name="txtprice" placeholder="Shoes Price" value="<?php echo $price1; ?>">
							</div>
							<div class="col-md-12 form-group">
								<select name="selca" class="form-control xyz1">
								<option value="0">Select Child/Adult</option>
								<option value="1" <?php if($ca1=="1"){ echo "selected='selected'"; } ?>>Child</option>
								<option value="2" <?php if($ca1=="2"){ echo "selected='selected'"; } ?>>Adult</option>
								</select>
							</div>
							<div class="col-md-12 form-group mb-3">
								<div class="creat_account">
								</div>
							</div>
							<div class="col-md-12 form-group ">
								Select Gender: <input type="radio" name="gender" value="MALE" <?php if($gender1=="MALE"){ echo "checked"; } ?>> MALE &nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="FEMALE" <?php if($gender1=="FEMALE"){ echo "checked"; } ?>> FEMALE
							</div>
							<div class="col-md-12 form-group">
							Select Image: 
								<input type="file" class="form-control"  name="txtimg" id="txtimg">
							</div>
							<div class="col-md-12 form-group">
							<?php
							if(isset($_REQUEST['esid']))
							{
							?>
								<img src="<?php echo $simg1; ?>" style="width:250px; height:150px;" >
								<br/>				<br/>
								<button type="submit" name="btnupdate" class="primary-btn" onclick="return update_validation();">UPDATE</button>
							<?php
							}else{
							?>
								<button type="submit" name="btnsave" class="primary-btn" onclick="return validation();">SAVE</button>
							<?php
							}
							?>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
								</div>
							</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="">
						<?php
						$qur1=mysqli_query($conn,"select * from shoes_detail");
						if(mysqli_num_rows($qur1)>0)
						{
							echo "<table class='table table-bordered'>
									<tr>
										<th>SHOES ID</th>
										<th>SHOES NAME</th>
										<th>CATEGORY</th>
										<th>DESCRIPTION</th>
										<th>PRICE</th>
										<th>GENDER</th>
										<th>CHILD/ADULT</th>
										<th>SHOES IMAGE</th>
										<th>EDIT</th>
										<th>DELETE</th>
										<th>ADD/VIEW SIZE</th>
									</tr>";
							while($q1=mysqli_fetch_array($qur1))
							{
								echo "<tr>";
								echo "<td>$q1[0]</td>";
								echo "<td>$q1[1]</td>";
								//echo "<td>$q1[2]</td>";
								$qur2=mysqli_query($conn,"select * from cat_master where cat_id='$q1[2]'");
								$q2=mysqli_fetch_array($qur2);
								echo "<td>$q2[1]</td>";
								echo "<td>$q1[3]</td>";
								echo "<td>$q1[4]</td>";
								echo "<td>$q1[5]</td>";
								//echo "<td>$q1[6]</td>";
								if($q1[6]=="1")
								{
									echo "<td style='color:red;'>CHILD</td>";
								}else{
									echo "<td style='color:green;'>ADULT</td>";
								}
								echo "<td><img src='$q1[7]' style='width:150px; height:150px;'></td>";
								echo "<td><a href='admin_manage_shoes.php?esid=$q1[0]'>EDIT</a></td>";
								echo "<td><a href='admin_manage_shoes.php?dsid=$q1[0]'>DELETE</a></td>";
								echo "<td><a href='admin_manage_size.php?sid=$q1[0]'>ADD/VIEW SIZE</a></td>";
								echo "</tr>";
							}
							echo "</table>";
						}else{
							echo "<h2>No Shoes Found</h2>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
<?php
include("footer.php")
?>