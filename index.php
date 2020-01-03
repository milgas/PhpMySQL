<?php include('includes/database.php'); ?>
<?php
	//Create the select query
	$query = "SELECT
				customers.id,
				customers.first_name,
				customers.last_name,
				customers.email,
				customers.password,
				customer_addresses.address,
				customer_addresses.address2,
				customer_addresses.city,
				customer_addresses.voivodeship,
				customer_addresses.country,
				customer_addresses.zipcode				
				FROM customers
				INNER JOIN customer_addresses
				ON customer_addresses.customer=customers.id
				ORDER BY join_date DESC ";
	//Get results
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Store Cmanager | Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Store Cmanager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_customer.php">Add Customer</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Customers</h1>
      	<?php
		//Show message if added or edited
			if(isset($_GET['msg'])){
			echo $_GET['msg'];
		} 
		?>
        <ul class="list-unstyled">
		<table class="table table-striped">
		  <tr>
			<th>Customer Name</th>
			<th>Email</th>
			<th>Address</th>
			<th></th>
		  </tr>
		  
		  <?php 
		  //Check if at least one row is found
		  if($result->num_rows > 0) {
			  //Loop through results
			  while($row = $result-> fetch_assoc()) {
				  //Display customer info
				  $output = '<tr>';
				  $output .='<td>'.$row['first_name'].' '.$row['last_name'].'</td>';
				  $output .='<td>'.$row['email'].'</td>';
				  $output .='<td>'.$row['address'].' '.$row['address2'].', '.$row['city'].', '.$row['voivodeship'].'</td>';
				  $output .='<td><a href="edit_customer.php?id='.$row['id'].'" class="btn btn-primary btn-sm">Edit</a></td>';
				  $output .='</tr>';
				  
				  //Echo output
				  echo $output;
			  }
		  } else {
			  echo "Sorry, no customers where found";
		  }
		  
		  ?>
		  
		  </table>
        </ul>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
