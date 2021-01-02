<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "SELECT
 leave_add.id,
leave_add.person_name,
leave_type.name as leave_type,
CONCAT(DATE_FORMAT(leave_add.datestart,'%d-%m'),'-',DATE_FORMAT(leave_add.datestart,'%Y')+543) AS datestart,
CONCAT(DATE_FORMAT(leave_add.dateend,'%d-%m'),'-',DATE_FORMAT(leave_add.dateend,'%Y')+543) AS dateend,
leave_add.halfday
FROM
 leave_add
INNER JOIN leave_type ON leave_add.leave_type = leave_type.id
order by  leave_add.id desc ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	
     array_push($return_arr,$row);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
