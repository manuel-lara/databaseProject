<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Create Account </title>
  <body>
    <header>
      <h1><a href="./Home.php"><i class="fa fa-bicycle"></i>TheBikeLocker</a></h1>
      <nav>
        <ul class="navbar-list">
          <li class="navbar-item"><a href="./Login.php">My Account</a></li>
          <li class="navbar-item"><a href="./Bikes.php">Bike Log</a></li>
          <li class="navbar-item"><a href="./reportStolen.php">Report Bike</a></li>
          <li class="navbar-item"><a href="./About.php">About</a></li>
          <?php
            if(isset($_SESSION['user_login'])) {
              echo "<li class='navbar-item navbar-right'><a href='./logOut.php'>Log Out</a></li>";
            }
            else{
              echo "<li class='navbar-item navbar-right'><a href='./Login.php'>Log In</a></li>";
            }
          ?>
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
				   <p>
			        <label for="email">*Email:</label>
			        <input type="text" name="email">
			    </p>
			    <p>
				 	<label for="pass">*Password:</label>
				 	<input type="password" name="pass">
			    </p>
			    <input type="submit" value="Submit" name="submit">
					</form>
      </div>
    </main>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>
</html>

<?php
  if (isset($_POST['submit'])) {

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

    // if required fields are filled
    if( !empty($username) && !empty($email) && !empty($pass) && !empty($fn) ) {
      // search if username exists
      $query = "SELECT 1 FROM Users WHERE userID = '$username' ";
      $result = mysqli_query($conn, $query);
      // create user
      if( mysqli_num_rows($result) < 1 ) { // if username isnt already in the table
        // hash and salt password
        // $hashPass = MD5($saltPass);

        // query to insert user into table
        $stmt = $conn->prepare("INSERT INTO Users (userID, name, email, pass) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $fn, $email, $pass);
        $stmt->execute();
        $stmt->close();

        echo "<script type='text/javascript'>alert('Account Succesfully Created!');</script>";
        $_SESSION['user_login'] = $username;
        echo "<script type='text/javascript'>window.location.assign('./Account.php');</script>";
      }
      else {
        echo "<script type='text/javascript'>alert('Username Exists, Choose A Different One!');</script>";
      }
    }
    else {
      echo "<script type='text/javascript'>alert('* Fields Required!');</script>";
    }
    mysqli_close($conn);
  }
?>
