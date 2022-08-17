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

	/*Drinks query - SELECT drink id, item from drinks */
	$all_drinks_query = "SELECT drink_id, drinks FROM drinks";
	$all_drinks_result = mysqli_query($dbcon, $all_drinks_query);


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
        <h2>Drinks Information</h2>
        <?php
            echo "<p>Drink Name: " .$this_drink_record['drinks']. "<br>";
            echo "Cost: $" .$this_drink_record['cost']. "</p>";
        ?>
		
		<h2>Select another drink</h2>
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
		
		<h2>Search for a drink</h2>
		<form action="" method="post">
			<input type="text" name="search">
			<input type="submit" name="submit" value="Search">
		</form>
		
		<?php
		
			if(isset($_POST['search'])) {
				$search = $_POST['search'];

				$query1 = "SELECT * FROM drinks WHERE drinks LIKE '%$search%'";
				$query = mysqli_query($dbcon, $query1);
				$count = mysqli_num_rows($query);

				if($count == 0){
					echo "There was no results";
				}else{

					while ($row = mysqli_fetch_array($query)) {
						echo $row ['drinks'];
						echo "<br>";
						echo "$" .$row['cost'];
						}
				}
				
			}
		?>
			
		
    </body>
</html>