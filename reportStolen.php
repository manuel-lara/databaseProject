<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title> Report </title>
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

				<h2> Report Bike </h2>

				<form action="" method="post">
			    <p>
			        <label for="username">*Username:</label>
			        <input type="text" name="userID">
			    </p>
			    <!-- <p>
			        <label for="postID">*postID:</label>
			        <input type="text" name="postID">
			    </p> -->
			    <p>
			        <label for="make">*make:</label>
			        <input type="text" name="make">
			    </p>
          <p>
				 	      <label for="model">*model:</label>
				 	      <input type="text" name="model">
			    </p>
				  <p>
			        <label for="serialnum">*serialnum:</label>
			        <input type="text" name="serialnum">
			    </p>
			    <p>
				 	<label for="location">*location:</label>
				 	<input type="text" name="location">
			    </p>
			    <p>
            <label for="report">*Report:</label>
						<input type="text" name="report">
			   	</p>
          <p>
            <label for="photo">*Photo url:</label>
						<input type="text" name="photo">
			   	</p>
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
        $userID = mysqli_real_escape_string($conn, $_POST['userID']);
        // $postID = mysqli_real_escape_string($conn, $_POST['postID']);
        $make = mysqli_real_escape_string($conn, $_POST['make']);
        $model = mysqli_real_escape_string($conn, $_POST['model']);
        $serial = mysqli_real_escape_string($conn, $_POST['serialnum']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $report = mysqli_real_escape_string($conn, $_POST['report']);
        $photo = mysqli_real_escape_string($conn, $_POST['photo']);
        // $imageId = 02;
        $stolen = 1;

        // if required fields are filled
        if( !empty($serial) ) {

          // search if username exists
          $query = "SELECT 1 FROM Bike WHERE serialnum = '$serial'";
          $result = mysqli_query($conn, $query);

          // $image = "SELECT COUNT(*) FROM Images";
          $imageID = mysqli_query($conn, "SELECT COUNT(*) FROM Images");
          $imageID = mysqli_num_rows($imageID);
          if($imageID < 1) { $imageID = 1; }

          // $post = ;
          $postID = mysqli_query($conn, "SELECT COUNT(*) FROM Posts");
          $postID = mysqli_num_rows($postID);
          if($postID < 1) { $postID = 1; }

          // create user
          if( mysqli_num_rows($result) < 1 ) { // if bike isnt already in the table
            // query to insert user into table
            $stmt = $conn->prepare("INSERT INTO Bike (serialnum, make, model, location, lost) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $serial, $make, $model, $location, $stolen);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO Posts (postID, userID, serialnum, report) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $postID, $userID, $serial, $report);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO Images (imageID, userID, postID, photo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $imageId, $userID, $postID, $photo);
            $stmt->execute();
            $stmt->close();

            echo "Bike Entered Into Database";
            echo $imageID.$userID.$postID.$photo;
            // echo "posts ".$postID;

          }
          else {
            echo "bike exists, Choose a different one.";
          }
        }
        else {
          echo "* fields required!";
        }

        // close connection
        mysqli_free_result($result);
        mysqli_close($conn);
?>
