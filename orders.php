<?php
/* Connect to the database */
$dbcon = mysqli_connect("localhost", "carolynmacaulay", "cE5wszu", "carolynmacaulay_cafe");

if(mysqli_connect_errno()) {
    echo "Could not connect to: ".mysqli_connect_error(); die();
    exit();}

else {
	echo "connected to the database";
	
}

/* get order id from index page of set default */
if(isset($_GET['order_sel'])) {
	$order_id = $_GET['order_sel'];
} else {
	$order_id = 1;
}

$this_order_query = "SELECT orders.order_id, customers.f_name, customers.l_name, drinks.drinks
FROM customers, orders, drinks
WHERE customers.customer_id = orders.customer_id
AND orders.drink_id = drinks.drink_id
AND orders.order_id = ' ".$order_id. "'";

$this_order_result = mysqli_query($dbcon, $this_order_query);

$this_order_record = mysqli_fetch_assoc($this_order_result);

/* Query the database */
$all_orders_query = "SELECT order_id FROM orders ORDER BY order_id ASC";
$all_orders_result = mysqli_query($dbcon, $all_orders_query);

	
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
			<li><a href="customers.php">Customers</a></li>
		</ul>
    </nav>
	
	<h2>Orders Information</h2>
	
	<?php
	
		echo "<h3> Order Number: <em>". $this_order_record['order_id'] ."</em></h3><br>";
		echo "Customer First Name: <em>". $this_order_record['f_name'] ."</em><br>";
		echo "Customer Last Name: <em>" . $this_order_record['l_name'] ."</em><br>";
		echo "Drink: <em>". $this_order_record['drinks'] ."</em></p>";
	?>
	
	<h2>Select another order</h2>
	    </form>

    <!--Orders form-->
    <form name='orders_form' id='orders_form' method='get' action='orders.php'>
        <select name='order_sel' id='order_sel'>
            <!--Options-->
            <?php
            while($all_orders_record = mysqli_fetch_assoc($all_orders_result)){
                echo "<option value = '". $all_orders_record['order_id'] . "'>";
                echo $all_orders_record['order_id'];
                echo "</option>";
            }
            ?>
        </select>
		 <input type="submit" name="orders_button" value="Show me another order">
    </form>

</main>
</body>
</html>