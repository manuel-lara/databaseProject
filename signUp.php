<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title> Create Account </title>
  <body>

    <header>
      <!-- The <i> tag below includes the sticky note icon from Font Awesome -->
      <h1><a href="/"><i class="fa fa-bicycle"></i>TheBikeLocker</a></h1>

      <nav>
        <ul class="navbar-list">
          <li class="navbar-item"><a href="./Home.php">Home</a></li>
          <li class="navbar-item"><a href="./Account.php">Account</a></li>
          <li class="navbar-item"><a href="./stolenBikes.php">Stolen Bikes log</a></li>
          <li class="navbar-item"><a href="./reportStolen.php">Report stolen bike</a></li>
          <li class="navbar-item"><a href="./signUp.php">Create Account</a></li>
          <li class="navbar-item navbar-right"><a href="./About.html">About</a></li>
        </ul>
      </nav>
    </header>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="screen">
  <link rel="stylesheet" href="style.css" media="screen">

  </head>
  <body>

    <main>
      <div class="info-container">

				<h2> Sign Up! </h2>

				<form action="" method="post">
			    <p>
			        <label for="username">*Username:</label>
			        <input type="text" name="username">
			    </p>
			    <p>
			        <label for="firstName">*First Name:</label>
			        <input type="text" name="firstName">
			    </p>
			    <!-- <p>
			        <label for="lastName">*Last Name:</label>
			        <input type="text" name="lastName">
			    </p> -->
				   <p>
			        <label for="email">*Email:</label>
			        <input type="text" name="email">
			    </p>
			    <p>
				 	<label for="pass">*Password:</label>
				 	<input type="text" name="pass">
			    </p>
			    <!-- <p>
						<input type="text" name="age">
			   	</p> -->
			    <input type="submit" value="Submit">
					</form>
      </div>
    </main>

  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>

  <!-- <script src="/index.js"></script> -->

</html>

<?php

include 'connect.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
  die('Could not connect: ' . mysql_error());
}

// Escape user inputs for security
$username = mysqli_real_escape_string($conn, $_POST['username']);
$fn = mysqli_real_escape_string($conn, $_POST['firstName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

// salt
// function generatesalt() {
//   return base64_encode(mcrypt_create_iv(5, mcrypt_dev_urandom));
// }

// if required fields are filled
if( !empty($username) && !empty($email) && !empty($pass) ) {

  // search if username exists
  $query = "SELECT 1 FROM Users WHERE username = '$username' ";
  $result = mysqli_query($conn, $query);

  // create user
  if( mysqli_num_rows($result) < 1 ) { // if username isnt already in the table

    // hash and salt password
    // $salt = generatesalt();
    // $saltPass = $pass.$salt;
    // $hashPass = MD5($saltPass);

    // query to insert user into table
    $stmt = $conn->prepare("INSERT INTO Users (userID, name, email, pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $username, $fn, $email, $pass);
    $stmt->execute();
    $stmt->close();
    echo " Account Succesfully Created.";

  }
  else {
    echo "username exists, Choose a different one.";
  }
}
else {
  echo "* fields required!";
}

// close connection
mysqli_close($conn);
?>
