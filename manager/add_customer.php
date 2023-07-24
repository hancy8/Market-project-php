<?php

include("header_manager.php");

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Customer</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Customer Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" class="form-control" name="address" />
</div>

<div class="form-group">
<label for="address">Name (Reference)</label>
<input type="text" class="form-control" name="reference_name" />
</div>

<div class="form-group">
<label for="address">Phone (Reference)</label>
<input type="text" class="form-control" name="reference_phone" />
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
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$reference_name=$_POST['reference_name'];
	$reference_phone=$_POST['reference_phone'];
	$date=date("d-m-Y");
	
	/* echo $name, $phone, $address, $products;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO customers(customer_name, customer_address, customer_phone, reference_name, reference_phone, date_added, status) VALUES('$name', '$address', '$phone', '$reference_name', '$reference_phone', '$date', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='customers.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='customers.php'; </script>";
}

?>