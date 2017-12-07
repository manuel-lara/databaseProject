<?php
  session_start();
	include 'connect.php';
  if(isset($_SESSION['user_login'])) {
    $currentUser = $_SESSION['user_login'];
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Account</title>
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

            if(isset($_SESSION['user_login'])) {
              echo "<h2> My Reports </h2>";
              $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
              if (!$conn) {
                die('Could not connect: ' . mysql_error());
              }
              // Retrieve info from "stolen bike table"
              $query = "SELECT Distinct * FROM Posts P
                        NATURAL JOIN Images I
                        NATURAL JOIN Bike B
                        WHERE P.userID = '$currentUser'";

              $result = mysqli_query($conn, $query);
              if (!$result) {
                die("Query to show fields from table failed");
              }

              echo "</tr>\n";
              while($row = mysqli_fetch_row($result)) {
                  echo "<section class='todo' style='background-Image: url($row[6])' >";
                  echo 	"<a href='bikePage.php?postID=$row[2]' >$row[7] $row[8] </a>";
                  echo 		"<div class='todo-body' >";
                  echo      "<img src='' data-id='$row[2]'>";
                  echo 		"</div>";
                  echo "<input onClick='rem($row[0], $row[1])'type='submit' value='Remove' name='Remove'>";
                  echo 	"</section>";
              }

              mysqli_free_result($result);
              mysqli_close($conn);
            }
            else {
              echo "<script type='text/javascript'>window.location.assign('./Login.php');</script>";
            }
          ?>
          <script>
                  function rem(ser, stol) {
                    window.location = './deletePost.php?postID=' + ser + '-' + stol;
                  }
          </script>
				</div>
			</main>
		</body>
	</html>
