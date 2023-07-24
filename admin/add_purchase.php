<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

/*$invoice=10000;
$sqli=mysqli_query($conn,"SELECT invoice_number FROM `purchases` ORDER BY `purchase_id` DESC LIMIT 0,1");
while($supp=mysqli_fetch_array($sqli))
	{
		$invoice=$supp['invoice_number'];
        $invoice++;
	}*/
?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Purchase</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="number">Truck Number</label>
<input type="text" class="form-control" name="number" required />
</div>

<div class="form-group">
<label for="city">City From</label>
<input type="text" class="form-control" name="city" />
</div>

<div class="form-group">
<label for="rent">Truck Rent</label>
<input type="number" class="form-control" name="rent" />
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
	$number=$_POST['number'];
	$city=$_POST['city'];
	$rent=$_POST['rent'];
	$invoice=$_POST['in_voice'];
	date_default_timezone_set('Asia/Karachi'); 
	
	$date=date("d-m-Y");
	$time=date("h:i A");
	
	/* echo $number, $city, $rent;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO purchases(truck_id, city, transport_cost, purchase_date, purchase_time, status) VALUES('$number', '$city', '$rent', '$date', '$time', 'open')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
			
		}
	
		else
		{
			// echo "<script> alert('Record Added Successfully!'); </script>";
			
			$get_purchase=mysqli_query($conn, "SELECT * FROM purchases ORDER BY purchase_id DESC LIMIT 1");
			
			while($select=mysqli_fetch_array($get_purchase))
			{
				$pur_id=$select['purchase_id'];
			}
			
			echo "<script> location='add_purchase_details.php?id=".$pur_id."'; </script>";
			
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='purchases.php'; </script>";
}

?>