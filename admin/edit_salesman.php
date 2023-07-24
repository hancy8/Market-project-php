<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$salesman_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM salesmen WHERE salesman_id='$salesman_id'");

while($select=mysqli_fetch_array($sql))
{
	$name=$select['salesman_name'];
	$address=$select['salesman_address'];
	$phone=$select['salesman_phone'];
	$user=$select['salesman_username'];
	$pass=$select['salesman_password'];
	$date=$select['date_created'];
	$status=$select['status'];
	$salary=$select['salary'];
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Salesman</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Salesman Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
</div>

<input type="hidden" name="salesmanid" value="<?php echo $salesman_id; ?>" />

<div class="form-group">
<label for="address">Address</label>
<textarea class="form-control" name="address"><?php echo $address; ?></textarea>
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" value="<?php echo $phone; ?>" />
</div>

<div class="form-group">
<label for="salary">Salary</label>
<input type="number" class="form-control" name="salary" value="<?php echo $salary; ?>" />
</div>
<div class="form-group">
<label for="user">Username</label>
<input type="text" class="form-control" name="username" value="<?php echo $user; ?>" />
</div>

<div class="form-group">
<label for="pass">Password</label>
<input type="text" class="form-control" name="password" value="<?php echo $pass; ?>" />
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
	// $salesman_id=$_POST['salesmanid'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$salary1=$_POST['salary'];
	/* echo $name, $address, $phone, $user, $pass;
	die(); */

		$sql=mysqli_query($conn, "UPDATE salesmen SET salesman_name='$name', salesman_address='$address', salesman_phone='$phone', salesman_username='$user', salesman_password='$pass', salary='$salary1' WHERE salesman_id='$salesman_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='salesmen.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='salesmen.php'; </script>";
}

?>