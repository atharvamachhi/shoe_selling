<?php
include("admin_header.php");
include("connect.php");

$sid=$_REQUEST['sid'];


$res1=mysqli_query($conn,"select max(size_id) from size_detail");
$sizeid=0;
while($r1=mysqli_fetch_array($res1))
{
	$sizeid=$r1[0];
}
$sizeid++;

?>
<script type="text/javascript">
	function validation()
	{
		var v=/^[0-9]+$/
		if(form1.txtsize.value=="")
		{
			alert("Please Enter Size");
			form1.txtsize.focus();
			return false;
		}else{
			if(!v.test(form1.txtsize.value))
			{
				alert("Please Enter Only Digit In Size");
				form1.txtsize.focus();
				return false;
			}
		}
	}
</script>
<?php
if(isset($_POST['btnsave']))
{
	$sizeid=$_POST['txtsizeid'];
	$sid=$_POST['txtsid'];
	$size=$_POST['txtsize'];
	$query="insert into size_detail values('$sizeid','$sid','$size')";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Size Inserted Succesfully');";
		echo "window.location.href='admin_manage_size.php?sid=$sid';";
		echo "</script>";
	}
}


if(isset($_REQUEST['dsid']))
{
	$sizeid1=$_REQUEST['dsid'];
	$sid=$_REQUEST['sid'];
	$query="delete from size_detail where size_id='$sizeid1'";
	if(mysqli_query($conn,$query))
	{
		echo "<script type='text/javascript'>";
		echo "alert('Size Deleted Succesfully');";
		echo "window.location.href='admin_manage_size.php?sid=$sid';";
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
						$qur1=mysqli_query($conn,"select * from size_detail where shoes_id='$sid'");
						if(mysqli_num_rows($qur1)>0)
						{
							echo "<table class='table table-bordered'>
									<tr>
										<th>SIZE ID</th>
										<th>SIZE</th>
										
										<th>DELETE</th>
									</tr>";
							while($q1=mysqli_fetch_array($qur1))
							{
								echo "<tr>";
								echo "<td>$q1[0]</td>";
								echo "<td>$q1[2]</td>";
								
								echo "<td><a href='admin_manage_size.php?dsid=$q1[0]&sid=$q1[1]'>DELETE</a></td>";
								echo "</tr>";
							}
							echo "</table>";
						}else{
							echo "<h2>No Size Found</h2>";
						}
						?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Category</h3>
						<form class="row login_form" method="post" name="form1">
							<div class="col-md-12 form-group">
								SIZE ID
								<input type="text" class="form-control"  name="txtsizeid" placeholder="Size Id" value="<?php echo $sizeid; ?>" readonly>
							</div>
							<div class="col-md-12 form-group">
								SHOES ID
								<input type="text" class="form-control"  name="txtsid" placeholder="Shoes Id" value="<?php echo $sid; ?>" readonly>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="txtsize" placeholder="Size" value="<?php echo $size1; ?>">
								
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