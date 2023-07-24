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
<h3>Salesmen Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_salesman.php">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Salary</th><th>Added On</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM salesmen");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='9' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$salesman_id=$select['salesman_id'];
	$name=$select['salesman_name'];
	$address=$select['salesman_address'];
	$phone=$select['salesman_phone'];
	$user=$select['salesman_username'];
	$pass=$select['salesman_password'];
	$date=$select['date_created'];
	$status=$select['status'];
	$salary=$select['salary'];
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$salesman_id'>
<td>".$salesman_id."</td>
<td>".$name."</td>
<td>".$address."</td>
<td>".$phone."</td>
<td>".$salary."</td>
<td>".$date."</td>
<td><a href='edit_salesman.php?id=$salesman_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='salesmandel($salesman_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
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