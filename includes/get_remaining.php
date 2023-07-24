<?php

include("connection.php");

$purchase_id=$_GET['pur_id'];
$supplier_id=$_GET['sup_id'];
$product_id=$_GET['pro_id'];
$quantity=$_GET['qty'];


// $gettotal=mysqli_query($conn, "SELECT DISTINCT b.quantity as count FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.status='open' && a.purchase_id='$purchase_id' && b.supplier_id='$supplier_id' && b.product_id='$product_id'");

$gettotal=mysqli_query($conn, "SELECT sum(quantity) as count FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.status='open' && a.purchase_id='$purchase_id' && b.supplier_id='$supplier_id' && b.product_id='$product_id'");

// $count=mysqli_num_rows($gettotal);

while($getinitialcount=mysqli_fetch_array($gettotal))
{
	$initial_count=$getinitialcount['count'];
}

/* echo $initial_count;
die(); */

$getsales=mysqli_query($conn, "SELECT sum(quantity) as sum FROM sales WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

while($getsalesum=mysqli_fetch_array($getsales))
{
	$sales_count=$getsalesum['sum'];
}

/* echo $sales_count;
die(); */

$totalcount=$initial_count-$sales_count;

/* echo $totalcount;
die(); */

if($totalcount>=0)
{

	$remaining=$totalcount-$quantity;

	echo $remaining;

}
else
{
	echo "";
}

?>