<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$sale_array=$_SESSION['sale_array'];

$get_product=mysqli_query($conn, "SELECT * FROM products WHERE product_id='".$sale_array['product_id']."'");
	while($product=mysqli_fetch_array($get_product))
	{
		$product_name=$product['product_name'];
	}

$get_supplier=mysqli_query($conn, "SELECT * FROM suppliers WHERE supplier_id='".$sale_array['supplier_id']."'");
	while($supplier=mysqli_fetch_array($get_supplier))
	{
		$supplier_name=$supplier['supplier_name'];
	}
	
$get_truck=mysqli_query($conn, "SELECT * FROM purchases WHERE purchase_id='".$sale_array['purchase_id']."'");
	while($truck=mysqli_fetch_array($get_truck))
	{
		$truck_number=$truck['truck_id'];
	}
	
?>

<div class="container">

<a href="add_sale.php" class="btn btn-sm btn-default">Create different Sale</a>

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Day Sale</h3></div>
<div class="panel-body">
<form method="post" name="add_sale_form" enctype="multipart/form-data">

<div class="row">

	
	
<div class="row">	
<table class="table" style="width:380px; margin:auto;">
<tr><th>Supplier</th><th>Truck</th><th>Product</th></tr>
<tr><td><?php echo $supplier_name; ?></td><td><?php echo $truck_number; ?></td><td><?php echo $product_name; ?></td></tr>
</table>
</div>
	
	<br>
	
	<input type="hidden" value="<?php echo $sale_array['salesman_id']; ?>" name="salesman" id="salesman">
	
	<input type="hidden" value="<?php echo $sale_array['supplier_id']; ?>" name="supplier" id="supplier">
	
	<input type="hidden" value="<?php echo $sale_array['purchase_id']; ?>" name="truck" id="truck">
	
	<input type="hidden" value="<?php echo $sale_array['product_id']; ?>" name="product" id="product">

	<div class="col-sm-6">
	<div class="form-group">
	<label for="quantity">Quantity</label>
	<input type="number" value="1" class="form-control" id="quantity" onchange="get_remaining()" name="quantity" />
	</div>

	</div>
	<div class="col-sm-6">
	<div class="form-group">
	<label for="remaining">Remaining</label>
	<input type="number" class="form-control" id="remaining" name="remaining" readonly />
	</div>
	</div>

</div>

<div class="row">

	<div class="col-sm-4">
	<div class="form-group">
	<label for="price">Price</label>
	<input type="number" value="100" class="form-control" onchange="calculate_total()" id="price" name="price" />
	</div>
	</div>
	
	<div class="col-sm-4">
	<div class="form-group">
	<label for="commission">Comission (%)</label>
	<input type="number" class="form-control" onchange="calculate_total()" id="commission" name="commission" />
	</div>
	</div>
	
	<div class="col-sm-4">
	<div class="form-group">
	<label for="total">Total</label>
	<input type="number" class="form-control" id="total" name="total" readonly />
	</div>
	</div>

</div>

<div class="form-check-inline">
  <label class="form-check-label">
  <input type="radio" id="debit" onclick="shuffle_payment('debit')" class="form-check-input" name="payment" value="debit" />Debit
  </label>&nbsp;&nbsp;&nbsp;
  <label class="form-check-label">
  <input type="radio" id="credit" onclick="shuffle_payment('credit')" class="form-check-input" name="payment" value="credit" />Credit
  </label>
</div>


<div class="form-group" id="credit_customer_section" hidden>
<label for="price">Customer's Name</label>
<select name="customer" id="customer" class="form-control">
<option disabled selected>Select Customer</option>
<?php
	$get_customer=mysqli_query($conn, "SELECT * FROM customers");
	while($customer=mysqli_fetch_array($get_customer))
	{
		$customer_id=$customer['customer_id'];
		$customer_name=$customer['customer_name'];
		
		echo '<option value="'.$customer_id.'">'.$customer_name.'</option>';
		
	}
?>
</select>
</div>

<button class="btn btn-primary" name="add">Add</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
</div>

</div>


</body>


<?php

if(isset($_POST['add']))
{
	$sale_status="open";
	
	$salesman_id=$sale_array['salesman_id'];
	$supplier_id=$sale_array['supplier_id'];
	$purchase_id=$sale_array['purchase_id'];    		   //Corresponds to a specific purchase
	$product_id=$sale_array['product_id'];
	
	$quantity=$_POST['quantity'];
	$price=$_POST['price'];
	$commission=$_POST['commission'];
	$total=$_POST['total'];
	
	if(isset($_POST['customer']))
	{
		$customer_id=$_POST['customer'];
	}
	else
	{
		$customer_id=0;		//To represent no customer
	}
	
	$remaining=$_POST['remaining'];
	
	if($remaining=0)  /* Check if all the products of a particular truck/purchase is sold */
							/* (if yes,) Change that purchase's status to closed */
	{
		
		$get_purchases=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id'");
		
		$purchases_total=0;
		
		while($purchase=mysqli_fetch_array($get_purchase))
		{
			// $product_id=$purchase['product_id'];
			$purchase_quantity=$purchase['quantity'];
			$purchases_total+=$quantity;
		}
		
		$get_sales=mysqli_query($conn, "SELECT * FROM sales WHERE purchase_id='$purchase_id'");
		
		$sales_total=0;
		
		while($sale=mysqli_fetch_array($get_sales))
		{
			// $product_id=$sale['product_id'];
			$sale_quantity=$sale['quantity'];
			$sales_total+=$quantity;
		}
		
		$sales_total+$quantity;
		
		if($purchases_total=$sales_total)
		{
			$sql=mysqli_query($conn, "UPDATE purchases SET status='closed' WHERE purchase_id='$purchase_id'");
			
			$sale_status="closed";
		}
	
	}
	
	date_default_timezone_set('Asia/Karachi'); 
	
	$date=date("d-m-Y");
	$time=date("h:i A");
	
	/* echo $salesman_id, $supplier_id, $purchase_id, $product_id, $quantity, $price, $commission, $total, $customer_id, $date, $time;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO sales(purchase_id, product_id, quantity, price, commission, supplier_id, salesman_id, customer_id, sale_date, sale_time, status) VALUES('$purchase_id', '$product_id', '$quantity', '$price', '$commission', '$supplier_id', '$salesman_id', '$customer_id', '$date', '$time', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
			
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			
			if($sale_status=="closed")
			{
				echo "<script> location='add_sale.php'; </script>";	//Return to the page for a new sale
			}
			else
			{
				echo "<script> location='add_single_sale.php'; </script>";
			}				
			
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='add_sale.php'; </script>";
}

?>