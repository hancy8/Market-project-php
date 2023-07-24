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
<h3>Purchases Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<a href="add_purchase.php"><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Truck</th><th>Date</th><th>Time</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM `purchases` WHERE status='open' ORDER BY purchase_id DESC");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='5' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$purchase_id=$select['purchase_id'];
	$truck=$select['truck_id'];
	$cost=$select['transport_cost'];
	$date=$select['purchase_date'];
	$time=$select['purchase_time'];
	$status=$select['status'];
	
echo "
<tr id='$purchase_id'>
<td>".$purchase_id."</td>
<td>".$truck."</td>
<td>".$date."</td>
<td>".$time."</td>
<td><a href='add_purchase_details.php?id=$purchase_id'><div class='btn btn-primary btn-sm'> View/Edit </div></a>&nbsp;<a href='#' onclick='purchasedel($purchase_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";

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