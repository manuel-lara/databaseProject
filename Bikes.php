<?php
  session_start();
	include 'connect.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Reported Bikes</title>
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
	            else {
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
	         if (isset($_SESSION['user_login'])) {
             echo "<h2> Reported Bikes </h2>
                  <form action='' method='post'>
                    <select name='stolen'>
                      <option value='1'>Stolen</option>
                      <option value='0'>Found</option>
                    </select>
                    <input type='submit' name='submit' value='Search' />
                  </form>";

                  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      						if (!$conn) {
      							die('Could not connect: ' . mysql_error());
      						}
      						// Retrieve info from "stolen bike table"
      						if(isset($_POST['stolen'])){
      							$selected_val =  $_POST['stolen'];
      							$query = "SELECT * FROM Posts P
                    NATURAL JOIN Images I
                    NATURAL JOIN Bike B
                    WHERE B.stolen = '$selected_val'";
      						}
      						else{
                    $query = "SELECT * FROM Posts P
                    NATURAL JOIN Images I
                    NATURAL JOIN Bike B";
      						}

      						$result = mysqli_query($conn, $query);
      						if (!$result) {
      							die("Query to show fields from table failed");
      						}
      						// get number of columns in table
      						$fields_num = mysqli_num_fields($result);

      						echo "</tr>\n";
      						while($row = mysqli_fetch_row($result)) {
      								echo "<section class='todo' style='background-Image: url($row[6])' >";
      								// echo 	"<a href='bikePage.php?serialnum=$row[0]&section=$row[1]' >$row[7] $row[8] </a>";
                      echo 	"<a href='bikePage.php?postID=$row[2]' >$row[7] $row[8] </a>";
      								echo 		"<div class='todo-body' >";
      								// echo 			"<p class='indent-wrapped'><span class='where'>where: </span>{{{where}}}</p>";
      								// echo 			"<p class='indent-wrapped'><span class='when'>when: </span>{{{when}}}</p>";
      								// echo 			"<p class='Serial'>{{{serial}}}</p>";
      								// echo 			"<p>{{{details}}}</p>";
      							  if ($row[1]) {
                        echo 			"<p> Stolen</p>";
      							  }
                      else {
                        echo 			"<p> Found</p>";
                      }
      								echo 		"</div>";
      								echo 	"</section>";
      						}
      						mysqli_free_result($result);
      						mysqli_close($conn);
	         }
           else{
             echo "<h2>Log In To View Reported Bikes</h2>";
           }
					?>
				</div>
			</main>
		</body>
	</html>
