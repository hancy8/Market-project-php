<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$salesman_id=$_GET['id'];
$name='';$amount=0; $paid_by='';

$sql=mysqli_query($conn, "SELECT * FROM `deadlock` WHERE id='$salesman_id'");

while($select=mysqli_fetch_array($sql))
{
	$name=$select['name'];
	$amount=$select['amount'];

}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Salesman</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
</div>

<input type="hidden" name="salesmanid" value="<?php echo $salesman_id; ?>" />


<div class="form-group">
<label for="amount">Amount</label>
<input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>" />
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
	$amount=$_POST['amount'];
	
	
	/* echo $name, $address, $phone, $user, $pass;
	die(); */

		$sql=mysqli_query($conn, "UPDATE deadlock SET name='$name', amount='$amount' WHERE id='$salesman_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='deadlock.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='deadlock.php'; </script>";
}

?>