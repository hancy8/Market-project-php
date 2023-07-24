<?php

session_start();

include("connection.php");

include("../includes/functions.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];

include("header_admin.php");


	if(isset($_GET['purchase_id']))
	{
		$pur_id=$_GET['purchase_id'];
	}
	
	if(isset($_GET['supplier_id']))
	{
		$sup_id=$_GET['supplier_id'];
		
		$get_sales=mysqli_query($conn, "SELECT * FROM sales WHERE purchase_id='$pur_id' && supplier_id='$sup_id' && status=1");
	}
	else
	{
		$get_sales=mysqli_query($conn, "SELECT * FROM sales WHERE purchase_id='$pur_id' && status=1");
	}
	
?>

<div class="container">
<a href="report.php"><-Return</a>
<br>
<h3>Sales</h3>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Supplier</th><th>Product</th><th>Customer</th><th>Quantity</th><th>Price</th><th>Bill</th><th>Commission (%)</th><th>Commission</th><th>Added On</th>
</tr>

<?php
$count=mysqli_num_rows($get_sales);

if($count==0)
{
	echo "<tr><td colspan='10' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($sales=mysqli_fetch_array($get_sales))
	{
		
		$sale_id=$sales['sale_id'];
		$salesman_id=$sales['salesman_id'];
		$supplier_id=$sales['supplier_id'];
		$cust_id=$sales['customer_id'];
		$pro_id=$sales['product_id'];
		$qty=$sales['quantity'];
		$price=$sales['price'];
		$bill=$sales['bill'];
		$purchase=$sales['purchase_id'];
		$date=$sales['sale_date'];
		$time=$sales['sale_time'];
		$commission_percent=$sales['commission_percentage'];
		$commission=$sales['commission'];
		$status=$sales['status'];
		
		$supplier=getSupplier($supplier_id);
		$product=getProduct($pro_id);
		$customer=getCustomer($cust_id);


		echo "<tr id='$sale_id'>
		<td>".$sale_id."</td>
		<td>".$supplier."</td>
		<td>".$product."</td><td>";
		
		if($customer!==0)
		{
			echo $customer;
		}
		
		echo "</td><td>".$qty."</td>
		<td>".$price."</td>
		<td>".$bill."</td>
		<td>".$commission_percent."</td>
		<td>".$commission."</td>
		<td>".$date."&nbsp;&nbsp;".$time."</td></tr>";
      
		
	}
	
}
?>

</table>

</div>