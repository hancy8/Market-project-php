<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$manager_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM managers WHERE manager_id='$manager_id'");

while($select=mysqli_fetch_array($sql))
{
	$name=$select['manager_name'];
	$address=$select['manager_address'];
	$phone=$select['manager_phone'];
	$salary=$select['manager_salary'];
	$user=$select['manager_username'];
	$pass=$select['manager_password'];
	$stock=$select['stock_access'];
	$customer=$select['customer_access'];
	$supplier=$select['supplier_access'];
	$status=$select['status'];	
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Manager</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Manager Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" value="<?php echo $phone; ?>" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" class="form-control" name="address" value="<?php echo $address; ?>" />
</div>

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" value="<?php echo $user; ?>" />
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="text" class="form-control" name="password" value="<?php echo $pass; ?>" />
</div>

<div class="form-group">
  <label for="stock_access">Stock Access</label>
  <select class="form-control" name="stock_access">
    <option value="1" <?php if($stock==1) { echo "selected"; } ?> >Grant</option>
    <option value="0" <?php if($stock==0) { echo "selected"; } ?> >Deny</option>
  </select>
</div>

<div class="form-group">
  <label for="customer_access">Customers Access</label>
  <select class="form-control" name="customer_access">
    <option value="1" <?php if($customer==1) { echo "selected"; } ?> >Grant</option>
    <option value="0" <?php if($customer==0) { echo "selected"; } ?> >Deny</option>
  </select>
</div>

<div class="form-group">
  <label for="product_access">Supplier Access</label>
  <select class="form-control" name="supplier_access">
    <option value="1" <?php if($supplier==1) { echo "selected"; } ?> >Grant</option>
    <option value="0" <?php if($supplier==0) { echo "selected"; } ?> >Deny</option>
  </select>
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
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$stock_access=$_POST['stock_access'];
	$customer_access=$_POST['customer_access'];
	$supplier_access=$_POST['supplier_access'];
	
	/* echo $name, $phone, $address, $user, $pass, $stock_access, $customer_access, $supplier_access;
	die(); */

		$sql=mysqli_query($conn, "UPDATE managers SET manager_name='$name', manager_address='$address', manager_phone='$phone', manager_username='$user', manager_password='$pass', stock_access='$stock_access', customer_access='$customer_access', supplier_access='$supplier_access' WHERE manager_id='$manager_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Resord Updated Successfully!'); </script>";
			echo "<script> location='managers.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='managers.php'; </script>";
}
?>