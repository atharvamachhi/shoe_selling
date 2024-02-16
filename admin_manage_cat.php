<?php
include("admin_header.php");
include("connect.php");

$res1=mysqli_query($conn,"select max(cat_id) from cat_master");
$catid=0;
while($r1=mysqli_fetch_array($res1))
{
	$catid=$r1[0];
}
$catid++;

?>
<script type="text/javascript">
	function validation()
	{
		var v=/^[a-zA-Z ]+$/
		if(form1.txtcat.value=="")
		{
			alert("Please Enter Category");
			form1.txtcat.focus();
			return false;
		}else{
			if(!v.test(form1.txtcat.value))
			{
				alert("Please Enter Only Alphabets in Your Category");
				form1.txtcat.focus();
				return false;
			}
		}
	}
</script>
<?php
if(isset($_POST['btnsave']))
{
	$catid=$_POST['txtcatid'];
	$cat=$_POST['txtcat'];
	$query="insert into cat_master values('$catid','$cat')";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Category Inserted Succesfully');";
		echo "window.location.href='admin_manage_cat.php';";
		echo "</script>";
	}
}

if(isset($_REQUEST['ecid']))
{
	$catid=$_REQUEST['ecid'];
	$res2=mysqli_query($conn,"select * from cat_master where cat_id='$catid'");
	$r2=mysqli_fetch_array($res2);
	$cat1=$r2[1];
}

if(isset($_POST['btnupdate']))
{
	$catid=$_POST['txtcatid'];
	$cat=$_POST['txtcat'];
	$query="update cat_master set category='$cat' where cat_id='$catid'";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Category Updated Succesfully');";
		echo "window.location.href='admin_manage_cat.php';";
		echo "</script>";
	}
}

if(isset($_REQUEST['dcid']))
{
	$catid1=$_REQUEST['dcid'];
	$query="delete from cat_master where cat_id='$catid1'";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Category Deleted Succesfully');";
		echo "window.location.href='admin_manage_cat.php';";
		echo "</script>";
	}
}
?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Manage Category</h1>
					
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
					<div class="">
						<?php
						$qur1=mysqli_query($conn,"select * from cat_master");
						if(mysqli_num_rows($qur1)>0)
						{
							echo "<table class='table table-bordered'>
									<tr>
										<th>CATEGORY ID</th>
										<th>CATEGORY</th>
										<th>EDIT</th>
										<th>DELETE</th>
									</tr>";
							while($q1=mysqli_fetch_array($qur1))
							{
								echo "<tr>";
								echo "<td>$q1[0]</td>";
								echo "<td>$q1[1]</td>";
								echo "<td><a href='admin_manage_cat.php?ecid=$q1[0]'>EDIT</a></td>";
								echo "<td><a href='admin_manage_cat.php?dcid=$q1[0]'>DELETE</a></td>";
								echo "</tr>";
							}
							echo "</table>";
						}else{
							echo "<h2>No Category Found</h2>";
						}
						?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Category</h3>
						<form class="row login_form" method="post" name="form1">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="txtcatid" placeholder="Category Id" value="<?php echo $catid; ?>" readonly>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="txtcat" placeholder="Category" value="<?php echo $cat1; ?>">
								
							</div>
							
							<div class="col-md-12 form-group">
							<?php
							if(isset($_REQUEST['ecid']))
							{
							?>
								<button type="submit" name="btnupdate" class="primary-btn" onclick="return validation();">UPDATE</button>
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