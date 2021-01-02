<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
position.name as data,

  sum(CASE when  leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_1,
  sum(CASE when  leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_2,
  sum(CASE when  leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_3,
  sum(CASE when  leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_4,
  sum(CASE when  leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_5,
 sum(CASE when  leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_6,
 sum(CASE when  leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_7

   
 FROM
   leave_add
 INNER JOIN leave_type on leave_add.leave_type = leave_type.id
INNER JOIN person on leave_add.id_person = person.id
INNER JOIN position on person.position = position.id
 WHERE
 datestart >=     case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '10/01' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y')-1 ,'/', '10/01' )  end 
  and dateend <= case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y')+1 ,'/', '09/30' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '09/30' )  end
GROUP BY position.name
  ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
       $a['years']=$row[years];
      $a['name']=$row[data];
 
      $a['data']=array((int)$row[leave_1],(int)$row[leave_2],(int)$row[leave_3],(int)$row[leave_4],(int)$row[leave_5],(int)$row[leave_6],(int)$row[leave_7]);
	
      array_push($return_arr,$a);
   }
   
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
