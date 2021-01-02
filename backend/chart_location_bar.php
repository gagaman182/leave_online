<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
location.name,
sum(case when DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 else DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leaveall

 


   
 FROM
   leave_add
 INNER JOIN leave_type on leave_add.leave_type = leave_type.id
INNER JOIN person on leave_add.id_person = person.id
INNER JOIN location on person.location = location.id
 WHERE
 datestart >=     case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '10/01' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y')-1 ,'/', '10/01' )  end 
  and dateend <= case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y')+1 ,'/', '09/30' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '09/30' )  end
GROUP BY location.name
  ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
      $a['years']=$row[years];
      $a['name']=$row[name];
      $a['leaveall']=intval($row[leaveall]);
	
     array_push($return_arr,$a);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
