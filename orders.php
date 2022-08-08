<?php
/* Connect to the database */
$dbcon = mysqli_connect("localhost", "carolynmacaulay", "cE5wszu", "carolynmacaulay_cafe");

if(mysqli_connect_errno()) {
    echo "Could not connect to: ".mysqli_connect_error(); die();
    exit();}

else {
	echo "connected to the database";
	
}
	
?>

<?php
$name = "Carolyn";
$email = "carolyn.macaulay@student.wegc.school.com";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Info</title>
</head>
<body>
<?php
echo "<h1>Coffee Shop</h1>";
?>

<main>
    <nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="drinks.php">Drinks</a></li>
			<li><a href="orders.php">Orders</a></li>
		</ul>
    </nav>
	
	<h2>Orders Information</h2>
    
</main>
</body>
</html>