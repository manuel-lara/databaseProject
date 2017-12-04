<!DOCTYPE html>
<!-- showTable.php CS 340 -->
<html>
	<head>
		<meta charset="utf-8">
		<title>Reported Bikes</title>
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

	        <h2> Reported Bikes </h2>


					<?php
						include 'connect.php';

						$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						if (!$conn) {
							die('Could not connect: ' . mysql_error());
						}
						// Retrieve info from "stolen bike table"
						$query = "SELECT * FROM Posts P INNER JOIN Images I ON P.postID = I.postID INNER JOIN Bike B on P.serialnum = B.serialnum";

						$result = mysqli_query($conn, $query);
						if (!$result) {
							die("Query to show fields from table failed");
						}
						// get number of columns in table
						$fields_num = mysqli_num_fields($result);
						// echo "<table id='t01' border='1'><tr>";


						echo "</tr>\n";
						while($row = mysqli_fetch_row($result)) {
							// $row is array... foreach( .. ) puts every element of $row to $cell variable
							// foreach($row as $cell) {
								echo "<section class='todo' style='background-Image: url($row[7])'>";
								echo 	"<h2>$row[9] $row[10]</h2>";
								echo 		"<div class='todo-body'>";
								echo 			"<p class='indent-wrapped'><span class='where'>where: </span>{{{where}}}</p>";
								echo 			"<p class='indent-wrapped'><span class='when'>when: </span>{{{when}}}</p>";
								echo 			"<p class='Serial'>{{{serial}}}</p>";
								echo 			"<p>{{{details}}}</p>";
							  echo 			"<p class='hidden'>http://cdn.mos.bikeradar.imdserve.com/images/bikes-and-gear/bikes/mountain-bikes/1450351584499-1wwm4j25hnwcn-1000-90.jpg</p";
								echo 		"</div>";
								echo 	"</section>";
							// }
						}
						mysqli_free_result($result);
						mysqli_close($conn);
					?>
				</div>
			</main>
		</body>
	</html>
