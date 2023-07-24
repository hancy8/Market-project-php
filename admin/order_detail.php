<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];


$order_id=$_GET['id'];

$sql=mysql_query("SELECT * FROM orders as a INNER JOIN order_items as b ON a.order_id=b.order_id WHERE b.order_id='$order_id'");

include("header_admin.php");

?>


		<nav class="wsmenu clearfix">
			<ul class="mobile-sub wsmenu-list">
			  <li><a class="active" href="admin.php">Home</a></li>
			
			  <li><a href="products.php">Manage Products</a></li>
			  
			  <li><a href="customers.php">Manage Customers</a></li>
			  
			  <li><a href="instalments.php">Manage Installments</a></li>
			  
			  <li><a href="report.php">Reports</a></li>
			  
			</ul>
		</nav>
              </div>
           </div>
           
        </div>
      </div>
    </div>
	
	<hr class="set-nav">
    
  </header>

<div class="container">

<div class="row">

<div class="col-sm-3">
<h3>Order Details - ID: <?php echo $order_id; ?></h3>
</div>
<form method="post">
<div class="col-sm-3" style="margin-top: 15px;">
<button class="btn btn-primary" name="approve">Approve Order</button>
</div>
<div class="col-sm-3" style="margin-top: 15px;">
<button class="btn btn-danger" name="del">Delete Request</button>
</div>
</form>
</div>

<br><br>

<table class="table table-striped table-bordered">
<tr>
<th>Index</th><th>Product Image</th><th>Name</th><th>Model</th><th>Pay Type</th><th>Quantity</th><th>Price</th>
</tr>



<?php
$i=1;

while($select=mysql_fetch_array($sql))
{
	$cus_id=$select['cus_id'];
	$order_id=$select['order_id'];
	$pro_id=$select['pro_id'];
	$qty=$select['qty'];
	$pay_type=$select['pay_type'];
	$date=$select['order_date'];
	$bill=$select['total_bill'];
	
	
	$get_pro=mysql_query("SELECT * FROM products WHERE pro_id='$pro_id'");

while($getpro=mysql_fetch_array($get_pro))
{
	$pro_name=$getpro['pro_name'];	
	$pro_img=$getpro['pro_img'];	
	$model=$getpro['model'];
	$full_price=$getpro['fixed_price'];
	$inst_price=$getpro['monthly_instalment'];
	
	$img = "../images/products/" . $pro_img;
}

if($pay_type=="full")
{
	$price=$full_price;
}
else
{
	$price=$inst_price;
}

	
echo "
<tr id='$order_id'>
<td>".$i."</td>
<td><img src='".$img."' width='100px' height='100px' /></td>
<td>".$pro_name."</td>
<td>".$model."</td>
<td>".$pay_type."</td>
<td>".$qty."</td>
<td>".$price."</td>
</tr>";

$i++;

}

?>

<tr><td colspan="7" style="border-top:solid 1px #17171; text-align:right;"><b>Total Bill ----- Rs: <?php echo $bill; ?> /-</b></td></tr>

</div>


</body>

<?php
if(isset($_POST['approve']))
{
	$check_cus=mysql_query("SELECT * FROM customers WHERE cus_id='$cus_id'");
	
	while($checkcus=mysql_fetch_array($check_cus))
	{
		$status = $checkcus['status'];
	}
	
	if($status==0)
	{
		$approve_cus=mysql_query("UPDATE customers SET status=1 WHERE cus_id='$cus_id'");
	}
	
	$approve_order=mysql_query("UPDATE orders SET status=1 WHERE order_id='$order_id'");

	// $get_order_details=mysql_query("SELECT DISTINCT pro_id FROM instalments WHERE order_id='$order_id' ORDER BY month DESC");
	
	$get_order_details=mysql_query("SELECT * FROM instalments WHERE order_id='$order_id' GROUP BY pro_id ORDER BY month DESC");
	
	while($orderdetails=mysql_fetch_array($get_order_details))
	{
		$product = $orderdetails['pro_id'];
		$month = $orderdetails['month'];
		
		$approve_order=mysql_query("UPDATE instalments SET status=1 WHERE order_id='$order_id' && pro_id='$pro_id' && month='$month'");
	}
	
	if($approve_order)
	{
		echo '<script> OrderUpdateAlert(); </script>';
	}
	
}

if(isset($_POST['del']))
{
	$del_req=mysql_query("DELETE FROM installments WHERE order_id='$order_id'");
	$del_req=mysql_query("DELETE FROM order_items WHERE order_id='$order_id'");
	$del_req=mysql_query("DELETE FROM orders WHERE order_id='$order_id'");
	
	if($del_req)
	{
		echo '<script> OrderDelAlert(); </script>';
	}
}

?>