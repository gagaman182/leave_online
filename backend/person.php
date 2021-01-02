<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

  //  $villcode = $_GET["villcode"];
  // $villcode = '90110164';

 $sql = "SELECT
 person.id,
 person.name,
 occupation.name as occupation,
location.name as location,
position.name as position,
person.leaveday
FROM
 person
INNER JOIN occupation on person.occupation = occupation.id
INNER JOIN location on person.location = location.id
INNER JOIN position on person.position = position.id ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
