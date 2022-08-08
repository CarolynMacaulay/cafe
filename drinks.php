<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "carolynmacaulay", "cE5wszu", "carolynmacaulay_cafe");

    /* Checks if DB connection was successful */
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Get from the drink id from index page else set default */
    if(isset($_GET['drink_sel'])) {
        $drink_id = $_GET['drink_sel'];
    } else {
        $drink_id = 1;
    }

    /* Create the SQL query */
    $this_drink_query = "SELECT * FROM drinks WHERE drinks.drink_id = '" .$drink_id . "'";

    /* Perform the query against the database */
    $this_drink_result = mysqli_query($dbcon, $this_drink_query);

    /* Fetch the result into an associative array */
    $this_drink_record = mysqli_fetch_assoc($this_drink_result);


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
			</ul>
    	</nav>
        <h2>Drinks Information</h2>
        <?php
            echo "<p>Drink Name: " .$this_drink_record['drinks']. "<br>";
            echo "Cost: $" .$this_drink_record['cost']. "</p>";
        ?>
    </body>
</html>