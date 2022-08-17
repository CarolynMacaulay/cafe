<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "carolynmacaulay", "cE5wszu", "carolynmacaulay_cafe");

    /* Checks if DB connection was successful */
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Get from the drink id from index page else set default */
    if(isset($_GET['customer_sel'])) {
        $customer_id = $_GET['customer_sel'];
    } else {
        $customer_id = 1;
    }

    /* Create the SQL query */
    $this_customer_query = "SELECT * FROM customers WHERE customers.customer_id = '" .$customer_id . "'";

    /* Perform the query against the database */
    $this_customer_result = mysqli_query($dbcon, $this_customer_query);

    /* Fetch the result into an associative array */
    $this_customer_record = mysqli_fetch_assoc($this_customer_result);

	/*Drinks query - SELECT drink id, item from drinks */
	$all_customers_query = "SELECT drink_id, drinks FROM drinks";
	$all_customers_result = mysqli_query($dbcon, $all_customers_query);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>

        <meta name="description" content="">
        <link href="css/styles.css" rel="stylesheet">

    </head>
    <body>
        <h1>Coffee Shop</h1>
        <!--List the information of the selected drink record-->
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="drinks.php">Drinks</a></li>
				<li><a href="orders.php">Orders</a></li>
				<li><a href="customers.php">Customers</a></li>
			</ul>
    	</nav>
        <h2>Customers Information</h2>
        <?php
            echo "<p>Customer ID: " .$this_customer_record['customer_id']. "<br>";
            echo "First Name: " .$this_customer_record['f_name']. "<br>";
			echo "Last Name: " .$this_customer_record['l_name']. "<br>";
        ?>
		
		<h2>Select another customer</h2>
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
				 <input type="submit" name="orders_button" value="Show me another drink">
		</form>
    </body>
</html>