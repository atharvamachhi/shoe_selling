<?php
session_start();
include("admin_header.php");
include("connect.php");


if(isset($_REQUEST['oid']))
{
	$oid=$_REQUEST['oid'];
	$bdate=date("Y-m-d");
	$res2=mysqli_query($conn,"select * from order_detail where order_id='$oid'");
	$r2=mysqli_fetch_array($res2);
	$cartid=$r2[2];
	$custid=$r2[3];
	$totamt=$r2[6];
	
	
	$res1=mysqli_query($conn,"select max(bill_id) from bill_detail");
	$bid=0;
	while($r1=mysqli_fetch_array($res1))
	{
		$bid=$r1[0];
	}
	$bid++;
	$query="insert into bill_detail values('$bid','$bdate','$oid','$cartid','$custid','$totamt')";
	if(mysqli_query($conn,$query))
	{	
	
		echo "<script type='text/javascript'>";
		echo "alert('Bill Generated Succesfully');";
		echo "window.location.href='bill.php?bid=$bid';";
		echo "</script>";
	}
}
?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Generate Bill</h1>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				
				
				
				<div class="col-lg-12">
					<div class="">
						<?php
						
						$qur1=mysqli_query($conn,"select * from order_detail where order_id not in (select order_id from bill_detail)");
						if(mysqli_num_rows($qur1)>0)
						{
							echo "<table class='table table-bordered'>
									<tr>
										<th>ORDER ID</th>
										<th>ORDER DATE</th>
										<th>CART ID</th>
										<th>CUSTOMER NAME</th>
										<th>DELIEVERY ADDRESS</th>
										<th>DELIEVERY MOBILE NO</th>
										<th>TOTAL AMOUNT</th>
										
										<th>VIEW ORDER DETAIL</th>
										<th>GENERATE BILL</th>
									</tr>";
							while($q1=mysqli_fetch_array($qur1))
							{
								echo "<tr>";
								echo "<td>$q1[0]</td>";
								echo "<td>$q1[1]</td>";
								echo "<td>$q1[2]</td>";
								//echo "<td>$q1[3]</td>";
								$qur2=mysqli_query($conn,"select * from cust_detail where cust_id='$q1[3]'");
								$q2=mysqli_fetch_array($qur2);
								echo "<td>$q2[1]</td>";
								
								echo "<td>$q1[4]</td>";
								echo "<td>$q1[5]</td>";
								echo "<td>&#8377; $q1[6] /-</td>";
								
								
								echo "<td><a href='admin_view_order_detail.php?cid=$q1[2]'>VIEW ORDER DETAIL</a></td>";
								echo "<td><a href='admin_generate_bill.php?oid=$q1[0]'>GENERATE BILL</a></td>";
								echo "</tr>";
							}
							echo "</table>";
						}else{
							echo "<h2>No Order Found</h2>";
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