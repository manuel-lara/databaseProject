<?php
include 'connect.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

session_start();
// $user_check = $_SESSION['user_login'];
echo $_SESSION['user_login']

// $query = "SELECT name, email, userID FROM Users WHERE userID= $user_check";
$query = "SELECT userID, name FROM Users WHERE userID= $_SESSION['user_login']";

$result = mysqli_query($conn, $query);
if (!$result) {
        die("Query to show fields test from table failed");
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
// $userEmail = $row['email'];
$userID = $row['userID'];

if (!isset($name)) {
        mysqli_close($conn);
        header('location: ./Home.php');
}
?>
