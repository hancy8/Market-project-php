<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

?>

<div class="container">

<a href="add_sale.php" class="btn btn-sm btn-default">Create different Sale</a>

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Day Sale</h3></div>
<div class="panel-body">
<form method="post" name="add_sale_form" enctype="multipart/form-data">
	
	
<div class="row">
	
<div class="col-sm-4">
<div class="form-group">
<label for="supplier">Supplier</label>
<select name="supplier" id="supplier" onchange="get_supplier_trucks(); OpenWin(this.value);" class="form-control">
<option disabled selected>Select Supplier</option>
<option value="new" style="text-decoration: blink; background-color: #347AB6;">New Supplier</option>
<?php
	$get_supplier=mysqli_query($conn, "SELECT * FROM suppliers");
	while($supplier=mysqli_fetch_array($get_supplier))
	{
		$supplier_id=$supplier['supplier_id'];
		$supplier_name=$supplier['supplier_name'];
		
		echo '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
		
	}
?>

</select>
<script type="text/javascript">
    function OpenWin(val) {
        var win = "add_supplier.php";
        if (val == "new") var winPop = window.open(win);
    }
     function openWin(val) {
        var win = "add_purchase.php";
        if (val == "new") var winPop = window.open(win);
    }
    </script>
</div>
</div>
</script>
<div class="col-sm-4">
<div class="form-group">
<label for="truck">Truck</label>
<select name="truck" id="truck" onchange="get_supplier_products(); openWin(this.value);" class="form-control">
<option disabled selected>Select Truck</option>
<option value="new" style="text-decoration: blink; background-color: #347AB6;">Add Truck</option>
</select>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label for="product">Product</label>
<select name="product" id="product" class="form-control">
<option disabled selected>Select Product</option>
</select>
</div>
</div>

</div>
	
	<br>

<div class="row">

	<div class="col-sm-6">
	<div class="form-group">
	<label for="quantity">Quantity</label>
	<input type="number" value="1" class="form-control" id="quantity" onkeyup="get_remaining()" name="quantity" />
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
	<input type="number" value="100" class="form-control" onkeyup="calculate_total()" id="price" name="price" />
	</div>
	</div>
	
	<div class="col-sm-4">
	<div class="form-group">
	<label for="commission">Comission (%)</label>
	<input type="number" class="form-control" onkeyup="calculate_total()" id="commission" name="commission" />
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
	
	$salesman_id=$_SESSION['user'];
	$supplier_id=$_POST['supplier'];
	$purchase_id=$_POST['truck'];          //Corresponds to a specific purchase
	$product_id=$_POST['product'];
	
	/* echo $salesman_id, $supplier_id, $purchase_id, $product_id;
	die(); */
	
	$quantity=$_POST['quantity'];
	$price=$_POST['price'];
	$commission_percent=$_POST['commission'];
	$total=$_POST['total'];
	
	$test=$total*$commission_percent;  // (Total Bill * Commission Percentage) / 100 = Total Commission
	$commission=$test/100;
	
	if(isset($_POST['customer']))
	{
		$customer_id=$_POST['customer'];
	}
	else
	{
		$customer_id=0;		//To represent no customer
	}
	
	$remaining=$_POST['remaining'];
	
	/* Check if all the products of a particular truck/purchase is sold */
	/* if($remaining=0)  
	{
		
		$get_purchases=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id'");
		
		$purchases_total=0;
		
		while($purchase=mysqli_fetch_array($get_purchase))
		{
			$purchase_quantity=$purchase['quantity'];
			$purchases_total+=$quantity;
		}
		
		$get_sales=mysqli_query($conn, "SELECT * FROM sales WHERE purchase_id='$purchase_id'");
		
		$sales_total=0;
		
		while($sale=mysqli_fetch_array($get_sales))
		{
			$sale_quantity=$sale['quantity'];
			$sales_total+=$quantity;
		}
		
		$sales_total+$quantity;
		
		if($purchases_total=$sales_total)
		{
			$update_purchase_status=mysqli_query($conn, "UPDATE purchases SET status='closed' WHERE purchase_id='$purchase_id'");
			
			$update_sale_status=mysqli_query($conn, "UPDATE sales SET status='2' WHERE purchase_id='$purchase_id'");
			
			$sale_status="closed";
		}
	
	} */
	
	if($remaining<0)
	{
		$sale_status="closed";
	}
	
	date_default_timezone_set('Asia/Karachi'); 
	
	$date=date("d-m-Y");
	$time=date("h:i A");
	
	/* echo $salesman_id, $supplier_id, $purchase_id, $product_id, $quantity, $price, $commission, $total, $customer_id, $date, $time;
	die(); */
if($sale_status=='open')
{
	$sql=mysqli_query($conn, "INSERT INTO sales(purchase_id, product_id, quantity, price, bill, commission_percentage, commission, supplier_id, salesman_id, customer_id, sale_date, sale_time, status) VALUES('$purchase_id', '$product_id', '$quantity', '$price', '$total', '$commission_percent', '$commission', '$supplier_id', '$salesman_id', '$customer_id', '$date', '$time', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
			
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			
			
			echo "<script> location='add_sale.php'; </script>";
			
			
		}
}
else			//In case user has selected invalid quantity
{
	echo "<script> alert('Invalid Quantity! Sale Exceeding Stock Limit.'); </script>";
}
		

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='add_sale.php'; </script>";
}

?>