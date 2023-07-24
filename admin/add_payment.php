<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");
$name='';$total_amount='';$remaining='';$paid='';
if(isset($_POST['search_btn']))
{
	$search=$_POST['search'];
	$sql=mysqli_query($conn, "SELECT * FROM `supplier_payment` WHERE sup_name='$search'");

while($select=mysqli_fetch_array($sql))
{

	$name=$select['sup_name'];
	$total_amount=$select['total_amount'];
	$remaining=$select['remn'];
	$paid=$select['total_paid'];

}

}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Supliers Payment</h3></div>
<div class="panel-body">

	


<form method="post" enctype="multipart/form-data">
<div class="form-group">
	<div class="col-sm-8">
<input type="search"  class="form-control" placeholder="Search Supplier" name="search" />
</div>
<div class="col-sm-4">
	<div class="form-group" style="">
<button type="submit" class="btn btn-primary" name="search_btn">Supplier</button>
</div>
</div>
</div>
<div class="form-group">
<label for="name">Supplier Name</label>
<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Total</label>
<input type="number" value="<?php echo $total_amount; ?>" class="form-control" name="total" />
</div>

<div class="form-group">
<label for="address">Remaining Amount</label>
<input type="text" id="remaining1" value="<?php echo $remaining; ?>"  class="form-control" name="remaining" />
</div>

<div class="form-group">
<label for="address">Paid</label>
<input type="text" value="<?php echo $paid; ?>" onchange="remaining_payment();" id="amount_paid"  class="form-control" name="amount_paid" />
</div>

<button class="btn btn-primary" name="update">Add</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
</div>

</div>


</body>


<?php


if(isset($_POST['update']))
{
	$name=$_POST['name'];
	$total1=$_POST['total'];
	$remnn=$_POST['remaining'];
	$paid_amount=$_POST['amount_paid'];
	

		$sql=mysqli_query($conn, "UPDATE `supplier_payment` SET `sup_name` = '$name', `total_amount` = '$total1', `remn` = '$remnn', `total_paid` = '$paid_amount' WHERE `supplier_payment`.`invoice` = '$supp_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='suppliers_payment.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='suppliers_payment.php'; </script>";
}

?>