<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

    $personid = $_GET["personid"];


 $sql = "SELECT
 person.id,
 person.name,
 occupation as occupation,
location as location,
position as position,
leaveday as leaveday
FROM
 person

where person.id = '".$personid."'
";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
