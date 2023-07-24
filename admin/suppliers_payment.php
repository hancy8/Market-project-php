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
<h3>Suppliers Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_payment.php">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Total</th><th>Remaining</th><th>Paid</th><th>Added On</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM supplier_payment");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='7' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$supplier_id=$select['invoice'];
	$name=$select['sup_name'];
	$address=$select['total_amount'];
	$phone=$select['remn'];
	$products=$select['total_paid'];
	$date=$select['date'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$supplier_id'>
<td>".$supplier_id."</td>
<td>".$name."</td>
<td>".$address."</td>
<td>".$phone."</td>
<td>".$products."</td>
<td>".$date."</td>
<td><a href='edit_payment.php? id=$supplier_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='delete_payment.php? id=$supplier_id' ><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
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