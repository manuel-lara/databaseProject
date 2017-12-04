<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title> My Account </title>
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

        <h2> Log In </h2>
        <!-- <form action="loginUser.php" method="post"> -->
        <form action="" method="post">
          <p>
            <label for="username">Username: </label>
            <input type="text" name="username">
          </p>
          <p>
              <label for="password">Password: </label>
              <input type="password" name="pass">
          </p>
          <input type="submit" value="Submit">

        </form>

      </div>
    </main>

  </body>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>

  <script src="/index.js"></script>

</html>


<?php
  include 'connect.php';

  $conn= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if(!$conn) {
    die('Connection failed: ' . mysqli_error() );
  }

  // grab input from form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);

  // build query
  $query = "SELECT 1 FROM Users WHERE userID = '$username' ";
  $result = mysqli_query($conn, $query);

  //attempt query
  if($row = mysqli_fetch_assoc($result)) {
    //user exists, check password;

    //hash and salt password and set as new variable
    // $salt = $row['salt'];
    // $saltPass = $pass.$salt;
    // $hashPass = MD5($saltPass);

    // query for username and password
    // $saltQuery = "SELECT 1 FROM Users WHERE username = '$username' and password = '$hashPass' ";
    $saltQuery = "SELECT 1 FROM Users WHERE userID = '$username' and pass = '$pass' ";
    $finalResult = mysqli_query($conn, $saltQuery);

    // if user and password are correct
    if($finalRow = mysqli_fetch_assoc($finalResult)) {
      echo "Logged In";

      session_start();
      $_SESSION['user_login'] = $username;

      echo "test" . $_SESSION['user_login'];
      header("location: ./Home.php");


    }
    else { // incorrect password
      echo "Incorrect Password";
    }
  }
  else { // username doesnt exist
    echo "Account does not exist/Incorrect information";
  }

  mysqli_free_result($result);
  mysqli_close($conn);
?>
