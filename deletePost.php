<?php
  session_start();
  include 'connect.php';
  $postID = $_GET['postID'];

  if(isset($_SESSION['user_login'])) {

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
      die('Could not connect: ' . mysql_error());
    }

    $query = "DELETE FROM Posts WHERE postID = '$postID'";

    $result = mysqli_query($conn, $query);

    mysqli_free_result($result);
    mysqli_close($conn);

    echo "<script type='text/javascript'>alert('$postID deleted');</script>";
    echo "<script type='text/javascript'>window.location.assign('./Account.php');</script>";
  }

?>
