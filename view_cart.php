<?php
session_start();
include("header.php");
include("connect.php");

if(!isset($_SESSION['cartid']))
{
	echo "<script type='text/javascript'>";
	echo "alert('Please Add Shoes Into Cart');";
	echo "window.location.href='shoes.php';";
	echo "</script>";
}

$cartid=$_SESSION['cartid'];

if(isset($_REQUEST['dcdid']))
{
	$cdid1=$_REQUEST['dcdid'];
	$query="delete from cart_detail where cart_d_id='$cdid1'";
	if(mysqli_query($conn,$query))
	{	
		echo "<script type='text/javascript'>";
		echo "alert('Shoes Deleted From Cart Succesfully');";
		echo "window.location.href='view_cart.php';";
		echo "</script>";
	}
}

if(isset($_REQUEST['oid']))
{
	if(isset($_SESSION['custid']))
	{
		header("Location: cust_checkout.php");
	}else{
		$_SESSION['oid']="x";
		header("Location: login.php");
	}
}

?>
<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Cart Detail</h1>
					
				</div>
			</div>
		</div>
	</section>

	
	<!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SHOES DETAIL</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
								<th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
						  $res1=mysqli_query($conn,"select * from cart_detail where cart_id='$cartid'");
						  if(mysqli_num_rows($res1)>0)
						  {
							$tot=0;
							 while($r1=mysqli_fetch_array($res1))
							 {
								$res2=mysqli_query($conn,"select * from shoes_detail where shoes_id='$r1[2]'");
								$r2=mysqli_fetch_array($res2);
						  ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="<?php echo $r2[7]; ?>" style="width:150px; height:100px;"alt="">
                                        </div>
                                        <div class="media-body">
                                            <p><?php echo $r2[1]; ?></p>
                                        </div>
                                    </div>
                                </td>
								<td>
                                    <h5><?php echo $r1[3]; ?></h5>
                                </td>
								<td>
                                    <h5><?php echo $r1[4]; ?></h5>
                                </td>
                                <td>
                                    <h5>&#8377; <?php echo $r1[5]; ?>/-</h5>
                                </td>
                                
                                <td>
                                    <h5>&#8377; <?php $amt=$r1[4]*$r1[5]; echo $amt; $tot+=$amt; ?>/-</h5>
                                </td>
								<td>
                                    <a href='update_cart_qty.php?sid=<?php echo $r1[2]; ?>'><img src="img/upd.png" style="width:50px; height:50px;"></a>
                                </td>
								<td>
                                    <a href='view_cart.php?dcdid=<?php echo $r1[0]; ?>'><img src="img/del.png" style="width:50px; height:50px;"></a>
                                </td>
                            </tr>
						<?php
							 }
						?>
                            
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
								<td>

                                </td>
                                <td>
                                    <h5>TOTAL</h5>
                                </td>
                                <td>
                                    <h5>&#8377; <?php echo $tot; ?>/-</h5>
                                </td>
								<td>

                                </td>
                                <td>

                                </td>
                            </tr>
                            
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
								<td>

                                </td>
                                <td>

                                </td>
								<td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="shoes.php">Continue Shopping</a>
                                        <a class="primary-btn" href="view_cart.php?oid=x">Proceed to checkout</a>
                                    </div>
                                </td>
								
                            </tr>
						<?php
						  }else
						  {
							  echo "No Shoes Found into Cart";
						  }
						  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

<?php
include("footer.php")
?>