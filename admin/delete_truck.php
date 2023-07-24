
<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$sale_id=$_GET['id'];
$purchase_id=$_GET['ids'];

	$sql=mysqli_query($conn, "DELETE FROM purchase_details WHERE purchase_detail_id='$sale_id'");
	

if($sql)
{
	echo "<script> alert('Record DELETE Successfully!'); </script>";
	echo "<script> location='add_purchase_details.php?id=".$purchase_id."'; </script>";

}

else
{
	echo "Error! Delete was Unsuccessful.";
	echo "<script> location='add_purchase_details.php?id=".$purchase_id."'; </script>";
}
?>


 