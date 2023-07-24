<?php

session_start();

include("../includes/connection.php");

if(!isset($_SESSION['user']))
{
	header('location:../index.php');
}

$user=$_SESSION['user'];

include("header_salesman.php");

if(isset($_SESSION['sale_array']))
{
	unset($_SESSION['sale_array']);
}
?>

<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Day Sale</h3></div>
<div class="panel-body">
<form method="post" name="add_sale_form" enctype="multipart/form-data">

<div class="form-group">
<label for="supplier">Supplier</label>
<select name="supplier" id="supplier" onchange="get_supplier_trucks()" class="form-control">
<option disabled selected>Select Supplier</option>
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
</div>

<div class="form-group">
<label for="truck">Truck</label>
<select name="truck" id="truck" onchange="get_supplier_products()" class="form-control">
<option disabled selected>Select Truck</option>
</select>
</div>

<div class="form-group">
<label for="product">Product</label>
<select name="product" id="product" class="form-control">
<option disabled selected>Select Product</option>
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
	$sale_array['salesman_id']=$user;
	$sale_array['supplier_id']=$_POST['supplier'];
	$sale_array['purchase_id']=$_POST['truck'];          //Corresponds to a specific purchase
	$sale_array['product_id']=$_POST['product'];
	
	/* print_r($sale_array);
	die(); */
	
	$_SESSION['sale_array']=$sale_array;
	
	echo "<script> location='add_single_sale.php'; </script>";
	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='sales.php'; </script>";
}

?>