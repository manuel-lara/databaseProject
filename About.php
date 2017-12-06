<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>About</title>
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

        <div class="homepage-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
        <h1> About goes here </h1>

      </div>
    </main>

  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>

  <script src="/index.js"></script>

</html>
<!-- > -->
