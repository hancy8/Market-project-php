<?php

session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];

include("header_admin.php");

?>

<div class="container">

<div>
<h3>Customers Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<a href="add_customer.php"><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Reference</th><th>Phone</th><th>Added On</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM customers");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='8' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$customer_id=$select['customer_id'];
	$name=$select['customer_name'];
	$address=$select['customer_address'];
	$phone=$select['customer_phone'];
	$reference_name=$select['reference_name'];
	$reference_phone=$select['reference_phone'];
	$date=$select['date_added'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$customer_id'>
<td>".$customer_id."</td>
<td>".$name."</td>
<td>".$address."</td>
<td>".$phone."</td>
<td>".$reference_name."</td>
<td>".$reference_phone."</td>
<td>".$date."</td>
<td><a href='edit_customer.php?id=$customer_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='customerdel($customer_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
}

}
?>

</table>
</div>

</div>
</body>

<?php
//include('footer_admin.php');
?>