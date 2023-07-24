<?php

session_start();

include("../includes/connection.php");

if(!isset($_SESSION['user']))
{
	header('location:../index.php');
}

$user=$_SESSION['user'];

include("header_salesman.php");

?>

<div class="container">

<div>
<h3>Welcome Back to Salesman Panel!</h3>

<br><br>

</div>

</div>
</body>

<?php
//include('footer_admin.php');
?>