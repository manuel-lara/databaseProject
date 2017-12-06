<?php
  session_start();
  include 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Report </title>
  <body>
    <header>
      <h1><a href="./Home.php"><i class="fa fa-bicycle"></i>TheBikeLocker</a></h1>
      <!-- <h1><?php echo $_SESSION['user_login'] ?> align="right"</h1> -->
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
      <div class='info-container'>
      <?php
        if (isset($_SESSION['user_login'])) {
          echo "<h2> Report Bike </h2>
                <form action='' method='post'>
              <p>
                  <label for='username'>Username: "; echo $_SESSION['user_login'];
          echo   "</label>
                  <!-- <input type='text' name='userID'> -->
              </p>
              <p>
                  <label for='make'>*Make:</label>
                  <input type='text' name='make'>
              </p>
              <p>
                    <label for='model'>*Model:</label>
                    <input type='text' name='model'>
              </p>
              <p>
                  <label for='serialnum'>*Serial Number:</label>
                  <input type='text' name='serialnum'>
              </p>
              <p>
              <label for='location'>*Location:</label>
              <input type='text' name='location'>
              </p>
              <p>
                <label for='report'>*Report:</label>
                <input type='text' name='report'>
              </p>
              <p>
                <label for='photo'>*Photo URL:</label>
                <input type='url' name='photo'>
              </p>
              <p>
                <select name='stolen'>
                  <option value='1'>Stolen</option>
                  <option value='0'>Found</option>
                </select>
              </p>
              <input type='submit' value='Submit' name='submit'>
              </form>";
        }
        else {
          echo "<h2> Log in to post </h2>";
        }
      ?>
      </div>
    </main>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>
</html>

<?php
  if (isset($_POST['submit'])) {

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
      die('Could not connect: ' . mysql_error());
    }

    // Escape user inputs for security
    $userID = mysqli_real_escape_string($conn, $_SESSION['user_login']);
    $make = mysqli_real_escape_string($conn, $_POST['make']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $serial = mysqli_real_escape_string($conn, $_POST['serialnum']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $report = mysqli_real_escape_string($conn, $_POST['report']);
    $photo = mysqli_real_escape_string($conn, $_POST['photo']);
    $stolen = mysqli_real_escape_string($conn, $_POST['stolen']);

    // if required fields are filled
    if( !empty($make) && !empty($model) && !empty($serial) && !empty($location) && !empty($report) && !empty($photo) ) {

      // search if username exists
      $query = "SELECT 1 FROM Bike
                WHERE serialnum = '$serial'
                AND stolen = '$stolen'
                ";
      $result = mysqli_query($conn, $query);

      // count how many posts exist to create postID
      // $query1 = mysqli_query($conn, "SELECT * FROM Bike");
      $postID = $serial."-".$stolen;
      // while($row = mysqli_fetch_row($query1)) {
      //   $postID = $postID+1;
      // }

      // create user
      if( mysqli_num_rows($result) < 1 ) { // if bike isnt already in the table
        // query to insert user into table
        $stmt = $conn->prepare("INSERT INTO Bike (serialnum, make, model, stolen, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $serial, $make, $model, $stolen, $location);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO Posts (postID, userID, serialnum, stolen,report) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $postID, $userID, $serial, $stolen, $report);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("UPDATE Images SET photo='$photo' WHERE postID = '$postID' ");
        $stmt->execute();
        $stmt->close();

        echo "<script type='text/javascript'>alert('Bike Entered Into Database!');</script>";
        echo "<script type='text/javascript'>window.location.assign('./Bikes.php');</script>";
      }
      else {
        echo "<script type='text/javascript'>alert('Bike Exists In DataBase Already!');</script>";
      }
    }
    else {
      echo "<script type='text/javascript'>alert('* Fields Required!');</script>";
    }
    // close connection
    mysqli_free_result($result);
    mysqli_close($conn);
  }
?>
