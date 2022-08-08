<?php
/* Connect to the database */
$dbcon = mysqli_connect("localhost", "carolynmacaulay", "cE5wszu", "carolynmacaulay_cafe");

if(mysqli_connect_errno()) {
    echo "Could not connect to: ".mysqli_connect_error(); die();
    exit();}

else {
	echo "connected to the database";
	
}
	
/*SQL querty to return all drinks*/
$drink_query ="SELECT  drinks.drinks, customers.f_name, customers.l_name
  FROM drinks, orders, customers
  AND customers.customer_id = orders.customer_id
  AND drinks.drink_id = orders.drink_id";

/*query the database*/
$drink_result = mysqli_query($dbcon, $drink_query);

/*count our results*/
$drink_rows = mysqli_num_rows($drink_result);

if($drink_rows > 0) {
    echo "There were ".$drink_rows." results returned.";
} else {
    echo "No results found.";
}

/*Drinks query - SELECT drink id, item from drinks */
$all_drinks_query = "SELECT drink_id, drinks FROM drinks";
$all_drinks_result = mysqli_query($dbcon, $all_drinks_query);

/* Store the query results*/
/* Remove if in while loop*/
/*$all_drinks_record = mysqli_fetch_assoc($all_drinks_result);*/

/* Query the database */
$all_orders_query = "SELECT order_id FROM orders ORDER BY order_id ASC";
$all_orders_result = mysqli_query($dbcon, $all_orders_query);

/* Store the query results*/
/* Remove if in while loop*/
/*$all_orders_record = mysqli_fetch_assoc($all_orders_result);*/


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
    <!-- Dropdown Drinks form-->
    <!--name for php; id for css; action page we go to when button clicked-->
    <form name='drinks_form' id='drinks_form' method='get' action='drinks.php'>
        <!--Dropdown menu-->
        <select name='drink_sel' id='drink_sel'>
            <!--Options-->

            <?php
            /* Display the query results into an option tag*/
            while($all_drinks_record = mysqli_fetch_assoc($all_drinks_result)){
				echo "<option value ='".$all_drinks_record['drink_id'] ."'>";
                echo $all_drinks_record['drinks'];   // Show the drink name in the option box
				echo "</option>";
            }
            ?>
        </select>
        <!--drink button-->
        <input type="submit" name="drinks_button" value="Show me the drink information">
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
        <input type="submit" name="orders_button" value="Show me the drink information">
    </form>
</main>
</body>
</html>