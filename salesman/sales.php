<?php

session_start();

include("../includes/connection.php");

include("../includes/functions.php");

if(!isset($_SESSION['user']))
{
	header('location:../index.php');
}

$user=$_SESSION['user'];

include("header_salesman.php");

?>

<div class="container">

<div>
<h3>Salesmen Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_sale.php">'; ?><div class="btn btn-default">New Day Sale</div></a>
</div>
</div>
<br>

<form class="form-inline text-center" method="post">
  <div class="form-group">
    <label for="date">Select Date:</label>
	<input type="date" class="form-control" name="date">
  </div>
  <button type="submit" name="sales_filter" class="btn btn-default">Submit</button>
</form>

<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Supplier</th><th>Product</th><th>Quantity</th><th>Price (Rs.)</th><th>Commission (%)</th><th>Added On</th><th>Action</th>
</tr>

<?php

if(isset($_POST['sales_filter']))
{
	
	/*if(isset($_POST['salesman']))
	{
		$salesman_id=$_POST['salesman'];
	} */
		
	if(isset($_POST['date']))
	{
		$getdate=$_POST['date'];
		$get_date=explode('-',$getdate);
		$date=$get_date[2].'-'.$get_date[1].'-'.$get_date[0];
		// die($getdate);
	}
	else
	{
		$date=date("d-m-Y");		 //Current Date
	}
	
	$sql=mysqli_query($conn, "SELECT * FROM sales WHERE salesman_id='$user' && sale_date='$date' ORDER BY sale_date DESC");
}
else
{
	$sql=mysqli_query($conn, "SELECT * FROM sales WHERE salesman_id='$user' ORDER BY sale_date DESC");
}

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='7' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$sale_id=$select['sale_id'];
	$salesman_id=$select['salesman_id'];
	$supplier_id=$select['supplier_id'];
	// $cust_id=$select['customer_id'];
	$pro_id=$select['product_id'];
	$qty=$select['quantity'];
	$price=$select['price'];
	$purchase=$select['purchase_id'];
	$date=$select['sale_date'];
	$time=$select['sale_time'];
	$commission=$select['commission'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
	// $customer=getCustomer($cust_id);
	$supplier=getSupplier($supplier_id);
	$product=getProduct($pro_id);
	// $category=getCategory($cat_id);
	
echo "
<tr id='$sale_id'>
<td>".$sale_id."</td>
<td>".$supplier."</td>
<td>".$product."</td>
<td>".$qty."</td>
<td>".$price."</td>
<td>".$commission."</td>
<td>".$date."&nbsp;&nbsp;".$time."</td>
<td><!--<a href='edit_sale.php?id=$sale_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;--><a href='#' onclick='saledel($sale_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
}

}
?>

</table>
</div>

</div>
</body>

<?php
//include('footer_admin.php');
?>