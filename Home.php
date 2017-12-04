<!DOCTYPE html>
<!-- <?php

  // include 'session.php';
  // echo $_SESSION['user_login'];

 ?> -->



<html>
  <head>

    <meta charset="utf-8">
    <title></title>
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

        <div class="homepage-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>

        <h1> This site was designed to help people recover their stolen bikes!</h1>
        <h1> Help us accomplish this by checking out the Stolen Bike Log page. </h1>

      </div>
    </main>

  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.runtime.js"></script>

  <script src="/index.js"></script>


</html>