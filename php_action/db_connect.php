<?php 	

$localhost = "localhost";
$username = "arnejasaksham";
$password = "Sak@192114";
$dbname = "Gymkhana";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
//   echo "Successfully connected";
}

if(isset($_SESSION['hostel'])) {
  $hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);
  // check connection
  if ($hostel->connect_error) {
    die("Connection Failed : " . $hostel->connect_error);
  } else {
    //   echo "Successfully connected";
  }
}
