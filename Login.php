<?php
  session_start();
  include 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title> My Account </title>
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
                echo "<li class='navbar-item navbar-right'><a href='./signUp.php'>Sign Up</a></li>";
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
      <?php
        if (isset($_SESSION['user_login'])) {
          echo "<script type='text/javascript'>window.location.assign('./Account.php');</script>";
        }
        else {
          echo "<div class='info-container'>
            <h2> Log In </h2>
            <form action='' method='post'>
              <p>
                <label for='username'>Username: </label>
                <input type='text' name='username'>
              </p>
              <p>
                <label for='password'>Password: </label>
                <input type='password' name='pass'>
              </p>
              <input type='submit' value='Submit'>
            </form>
          </div>";
        }
      ?>
    </main>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>
</html>

<?php
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

  //log in
  if($row = mysqli_fetch_assoc($result)) {
    // $hashPass = MD5($saltPass);

    // query for username and password
    $saltQuery = "SELECT 1 FROM Users WHERE userID = '$username' and pass = '$pass' ";
    $finalResult = mysqli_query($conn, $saltQuery);

    // if user and password are correct
    if($finalRow = mysqli_fetch_assoc($finalResult)) {

      $_SESSION['user_login'] = $username;

      echo "<script type='text/javascript'>alert('Logged In');</script>";
      echo "<script type='text/javascript'>window.location.reload();</script>";
    }
    else { // incorrect password
      echo "<script type='text/javascript'>alert('Account does not exist/Incorrect information');</script>";
    }
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>
