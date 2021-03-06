<?php include('includes/database.php'); ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	//Assign get variable
	$id = $_GET['id'];
	
	//Create customer select query
	$query ="SELECT * FROM customers
				INNER JOIN customer_addresses
				ON customer_addresses.customer=customers.id
				WHERE customers.id = $id";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	if($result = $mysqli->query($query)){
		//Fetch object array
		while($row = $result->fetch_assoc()){
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$password = $row['password'];
			$address = $row['address'];
			$address2 = $row['address2'];
			$city = $row['city'];
			$voivodeship = $row['voivodeship'];
			$country = $row['country'];
			$zipcode = $row['zipcode'];
		}
		//Free results set_error_handler
		$result->close();
	}
?>

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if($_POST){
	//Assign GET Variable
	$id = $_GET['id'];
	
	//Assign Variables
	//Checking for POST - > getting id from url -> putting post variable into variable
	$first_name = $mysqli -> real_escape_string($_POST['first_name']);
	$last_name = $mysqli -> real_escape_string($_POST['last_name']);
	$email = $mysqli -> real_escape_string($_POST['email']);
	$password = $mysqli -> real_escape_string(($_POST['password']));
	$address = $mysqli -> real_escape_string($_POST['address']);
	$address2 = $mysqli -> real_escape_string($_POST['address2']);
	$city = $mysqli -> real_escape_string($_POST['city']);
	$voivodeship = $mysqli -> real_escape_string($_POST['voivodeship']);
	$country = $mysqli -> real_escape_string($_POST['country']);
	$zipcode = $mysqli -> real_escape_string($_POST['zipcode']);
	
	//Create customer update
	$query = "UPDATE customers
			SET
			first_name='$first_name',
			last_name='$last_name',
			email='$email',
			password='$password',
			WHERE id='$id'
			";
	$mysqli->query($query) or die();
	
	//Create address update
	$query = "UPDATE customer_addresses
			SET
			address='$address',
			address2='$address2',
			city='$city',
			voivodeship='$voivodeship',
			country='$country',
			zipcode='$zipcode'
			WHERE customer='$id'
			";
	$mysqli->query($query) or die();
	
	$msg="Customer Updated";
	header('Location: index.php?msg='.urlencode($msg).'');
	exit;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Store Cmanager | Edit Customer</title>

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
        <h1 class="mt-5">Edit Customer</h1>
			<form role="form" method="post" action="edit_customer.php?id=<?php echo $id; ?>">
			<div class="form-group">
				<label>First Name</label>
				<input name="first_name" type="text" class="form-control"
				value="<?php echo $first_name; ?>" placeholder="Enter First Name">
			</div>
			<div class="form-group">
				<label> Last Name</label>
				<input name="last_name" type="text" class="form-control"
				value="<?php echo $last_name; ?>" placeholder="Enter Last Name">
			</div>
			<div class="form-group">
				<label> Email address</label>
				<input name="email" type="email" class="form-control"
				value="<?php echo $email; ?>" placeholder="Enter Email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input name="password" type="password" class="form-control"
				value="<?php echo $password; ?>" placeholder="Enter Password">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input name="address" type="text" class="form-control"
				value="<?php echo $address; ?>" placeholder="Enter First Address">
			</div>
			<div class="form-group">
				<label>Address 2</label>
				<input name="address2" type="text" class="form-control"
				value="<?php echo $address2; ?>" placeholder="Enter Address 2">
			</div>
			<div class="form-group">
				<label>City</label>
				<input name="city" type="text" class="form-control"
				value="<?php echo $city; ?>" placeholder="Enter City">
			</div>
			<div class="form-group">
				<label>Voivodeship</label>
				<input name="voivodeship" type="text" class="form-control"
				value="<?php echo $voivodeship; ?>" placeholder="Enter Voivodeship">
			</div>
			<div class="form-group">
				<label>Country</label>
				<input name="country" type="text" class="form-control"
				value="<?php echo $country; ?>" placeholder="Enter Country">
			</div>
			<div class="form-group">
				<label>Zipcode</label>
				<input name="zipcode" type="text" class="form-control"
				value="<?php echo $zipcode; ?>" placeholder="Enter Zipcode">
			</div>
				<input type="submit" class="btn btn-primary btn-sm" value="Save">
			</form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
