<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

    $leaveid = $_GET["leaveid"];


 $sql = "SELECT
 leave_add.id,
leave_add.person_name,
leave_add.leave_type ,
datestart,
dateend,
halfday
FROM
 leave_add
INNER JOIN leave_type ON leave_add.leave_type = leave_type.id
where leave_add.id  = '".$leaveid."'


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
