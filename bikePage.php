<?php
  session_start();
  // if(isset($_SESSION['user_login'])) {
  //   $current_user = $_SESSION['user_login'];
  // }
  include 'connect.php';
?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title><?php echo $_GET['postID']?></title>
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
          <?php

            $postID = $_GET['postID'];
            // $stolen = $_GET['section'];

            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) {
              die('Could not connect: ' . mysql_error());
            }
            // Retrieve info from "stolen bike table"
            $query = "SELECT * FROM Posts P INNER JOIN Images I ON P.postID = I.postID
                      INNER JOIN Bike B on P.serialnum = B.serialnum INNER JOIN Users U ON P.userID = U.userID
                      WHERE P.postID = '$postID'
                      ";
                      // AND B.stolen = '$stolen'

            $result = mysqli_query($conn, $query);
            if (!$result) {
              die("Query to show fields from table failed");
            }

            while($row = mysqli_fetch_row($result)) {
                echo "<h2>$row[10] $row[11]</h2>";
                echo    "<div class='bike-body'>";
                echo    "<p class='indent-wrapped'><span class='where'>Location: </span>$row[13]</p>";
                echo    "<p class='indent-wrapped'><span class='Serial'>Serial#: </span>$row[2]</p>";
                echo    "<p class='indent-wrapped'><span class='Owner'>Contact: </span>$row[15]</p>";
                echo "<img src='$row[8]' style= 'width: 100%'";
                echo  "</div>";

                $query = "SELECT userID, content FROM Comment WHERE postID = $row[0]";

              	$result = mysqli_query($conn, $query);
              	if (!$result) {
              		die("Query to show fields from table failed");
              	}

              	echo "<h1> Comments </h1>
              	     <table id='t01' align='center' border='1'><tr>
              	     <td><b>User</b></td>
                     <td><b>Comment</b></td>";


              	while($row = mysqli_fetch_row($result)) {
              		echo "<tr>";
              		foreach($row as $cell)
              			echo "<td>$cell</td>";
              		echo "</tr>\n";
              	}
            }
            mysqli_free_result($result);
            mysqli_close($conn);
          ?>
        </div>
      </main>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>
  </html>
