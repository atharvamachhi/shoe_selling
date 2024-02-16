<?php
include("connect.php");
?>
<html>
<head>
</head>
<body onload="window.print();">
	
	<table border='1' align="center" width="80%">
		<tr>
			<td colspan="2" align="center"><img src="img/logo1.jpg" style="width:228px; height:100px;" alt="" />
		<br/>
			2nd Floor Trade Center, <br/>
											Tithal Road,<br/>
											Valsad: 396001,<br/>
											Gujarat (India)
			</td>	
		</tr>
	</table>
	<table border='1' align="center" height="50%" width="80%">
		<tr>
			
			<td>SHOE NAME</td>
			<td>SHOE SIZE</td>
			<td>QUANTITY</td>
			<td>PRICE</td>
			<td>AMOUNT</td>
		</tr>
	<?php
		$tot=0;
		if(isset($_REQUEST['bdid']))
		{
			$bid=$_REQUEST['bdid'];
		}else {
			$bid=$_REQUEST['bid'];
		
		}	
		$qur=mysqli_query($conn,"select c.cart_id,c.shoes_id,s.shoes_name,c.size,c.qty,c.price from cart_detail c,shoes_detail s where c.shoes_id=s.shoes_id and c.cart_id=(select cart_id from bill_detail where bill_id='$bid')");
		while($q=mysqli_fetch_row($qur))
		{
			echo "<tr>";
			
			echo "<td>$q[2]</td>";
			echo "<td>$q[3]</td>";
			echo "<td>$q[4]</td>";
			echo "<td>$q[5]</td>";
			$amt=$q[4]*$q[5];
			echo "<td>Rs. $amt /-</td>";
			echo "</tr>";
			$tot=$tot+$amt;
		}
	?>
		<tr>
			<td colspan="4"><h4 style='float:right;'>Total Amount</h4><br>
			</td>
			<td  align="right">Rs. <?php echo $tot; ?>/-</td>
		</tr>
	</table>
	<?php
	if(isset($_REQUEST['bdid']))
		{
	?>

		<?php
			
			
		}else if(isset($_REQUEST['bddid']))
		{
			?>
		
			<?php
		}else{
		?>
	<a href="admin_generate_bill.php">BACK</a>
		<?php
		}	
		?>
	
</body>

</html>