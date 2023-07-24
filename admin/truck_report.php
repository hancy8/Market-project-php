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
	<div class="form-group">
         <select class="form-control" id="select-box">
         	<option selected>Select Report</option>
         	<option value="1">Truck closing</option>
         	<option value="2">Sales</option>
         	
         </select>
		
	</div>

<div id="report">
<h3>Truck Closing</h3>

<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Truck</th><th>Date</th><th>Time</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM purchases WHERE status='open'");

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
<td><a href='report.php?id=$purchase_id &name=$truck'>".$purchase_id."</a></td>
<td><a href='report.php?id=$purchase_id &name=$truck'>".$truck."</a></td>
<td><a href='report.php?id=$purchase_id &name=$truck'>".$date."</a></td>
<td>".$time."</td>
<td><a href='report.php?id=$purchase_id &name=$truck'><div class='btn btn-primary btn-sm'> View </div></a>";

}

}
?>

</table>
</div>

</div>
<script type="text/javascript">
	      $('#select-box').change(function(){ 
        
        if($(this).val() == 1){
        	var dataS=$(this).val();
          $.ajax({
 	type: "POST",
    url: "truck_report1.php",
    data: dataS,
    success: function(r){
          $("#report").html(r);
          //alert(r);
       }
 		});
        } 

        if($(this).val() == 2){
          var dataS=$(this).val();
          $.ajax({
  type: "POST",
    url: "sale_report.php",
    data: dataS,
    success: function(r){
          $("#report").html(r);
          //alert(r);
       }
    });
        }
      });  

</script>
</body>

<?php
//include('footer_admin.php');
?>