<?php

session_start();

include("connection.php");

include("../includes/functions.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];
?>

<div class="container">
	<div>
<h3>Sales</h3>
<br>
<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Truck</th><th>Product</th><th>Quantity</th><th>Price</th><th>Bill</th><th>Date</th><th>Time</th><th>Commission</th><th>Supplier</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM sales");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='5' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$sale_id=$select['sale_id'];
	$purchase_id=$select['purchase_id'];
	$product_id=$select['product_id'];
	$quantity=$select['quantity'];
	$date=$select['sale_date'];
	$time=$select['sale_time'];
	$price=$select['price'];
	$bill=$select['bill'];
	$commission=$select['commission'];
	$supplier_id=$select['supplier_id'];
	$salesman_id=$select['salesman_id'];
	$customer_id=$select['customer_id'];
	$supplier=getSupplier($supplier_id);
	$product=getProduct($product_id);
	$customer_id=getCustomer($customer_id);
	$truck=getTruck($purchase_id);

	
echo "
<tr>
<td>".$sale_id."</td>
<td>".$truck."</td>
<td>".$product."</td>
<td>".$quantity."</td>
<td>".$price."</td>
<td>".$bill."</td>
<td>".$date."</td>
<td>".$time."</td>
<td>".$commission."</td>
<td>".$supplier."</td>
";

}

}
?>
</div>
</div>
