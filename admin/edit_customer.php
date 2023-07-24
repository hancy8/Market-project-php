<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$customer_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM customers WHERE customer_id='$customer_id'");

while($select=mysqli_fetch_array($sql))
{

	$name=$select['customer_name'];
	$address=$select['customer_address'];
	$phone=$select['customer_phone'];
	$reference_name=$select['reference_name'];
	$reference_phone=$select['reference_phone'];
	$date=$select['date_added'];
	$status=$select['status'];
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Customer</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Customer Name</label>
<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" value="<?php echo $phone; ?>" class="form-control" name="phone" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" value="<?php echo $address; ?>" class="form-control" name="address" />
</div>

<div class="form-group">
<label for="address">Name (Reference)</label>
<input type="text" value="<?php echo $reference_name; ?>" class="form-control" name="reference_name" />
</div>

<div class="form-group">
<label for="address">Phone (Reference)</label>
<input type="text" class="form-control" value="<?php echo $reference_phone; ?>" name="reference_phone" />
</div>


<button class="btn btn-primary" name="update">Update</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
</div>

</div>


</body>


<?php

if(isset($_POST['update']))
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$reference_name=$_POST['reference_name'];
	$reference_phone=$_POST['reference_phone'];
	
	/* echo $name, $phone, $address, $products;
	die(); */

		$sql=mysqli_query($conn, "UPDATE customers SET customer_name='$name', customer_address='$address', customer_phone='$phone', reference_name='$reference_name', reference_phone='$reference_phone' WHERE customer_id='$customer_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='customers.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='customers.php'; </script>";
}

?>