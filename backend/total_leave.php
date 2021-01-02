<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "
 select x.name,
 x.leaveday,
 MONTHs.leave_type1_total,
 months.leave_type1,
 months.leave_type2,
 months.leave_type3,
 months.leave_type4,
 months.leave_type5,
 months.leave_type6,
 months.leave_type7 from (
 SELECT
 
  person.id ,
  person.name,
  person.leaveday
 
  FROM
   person)x
 left outer JOIN 
  (SELECT
 
  person.id,
  person.name,
  person.leaveday,
 IF(person.leaveday in ('',null,'0')   , sum(CASE when  leave_type.id = '1'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1    
when  leave_type.id = '1'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end)- sum(IF(leave_add.halfday > 0 and leave_type.id = '1','0.5','0' )), (person.leaveday)-sum(CASE when  leave_type.id = '1'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
when  leave_type.id = '1'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end)- sum(IF(leave_add.halfday > 0 and leave_type.id = '1','0.5','0' ))+1)  as leave_type1_total
,
   sum(CASE when  leave_type.id = '1'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '1'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '1','0.5','0' ))  as leave_type1,
  sum(CASE when  leave_type.id = '2'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '2'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '2','0.5','0' ))  as leave_type2,
  sum(CASE when  leave_type.id = '3'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '3'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '3','0.5','0' ))  as leave_type3,
  sum(CASE when  leave_type.id = '4'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '4'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '4','0.5','0' )) as leave_type4,
  sum(CASE when  leave_type.id = '5'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '5'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '5','0.5','0' )) as leave_type5,
  sum(CASE when  leave_type.id = '6'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '6'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end)  - sum(IF(leave_add.halfday > 0 and leave_type.id = '6','0.5','0' )) as leave_type6,
  sum(CASE when  leave_type.id = '7'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '7'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) - sum(IF(leave_add.halfday > 0 and leave_type.id = '7','0.5','0' )) as leave_type7
  
  FROM
   person
  INNER JOIN leave_add ON person.id = leave_add.id_person
  INNER JOIN leave_type on leave_add.leave_type = leave_type.id


 
  where    datestart >=     case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '10/01' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y')-1 ,'/', '10/01' )  end 
  and dateend <= case when  DATE_FORMAT(CURRENT_DATE,'%m') in ( '10','11','12' ) then concat(DATE_FORMAT(CURRENT_DATE,'%Y')+1 ,'/', '09/30' )
  else concat(DATE_FORMAT(CURRENT_DATE,'%Y') ,'/', '09/30' )  end
  GROUP BY 	person.id,
  person.name)months
 ON x.id = months.id
 
 
 
 ";


$return_arr = array();
$id = 1;
if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
      $a['num']=$id++;
      $a['name']=$row[name];
      $a['leaveday']=$row[leaveday];
      $a['leave_type1_total']=floatval($row[leave_type1_total]);
      $a['leave_type1']=floatval($row[leave_type1]);
      $a['leave_type2']=floatval($row[leave_type2]);
      $a['leave_type3']=floatval($row[leave_type3]);
      $a['leave_type4']=floatval($row[leave_type4]);
      $a['leave_type5']=floatval($row[leave_type5]);
      $a['leave_type6']=floatval($row[leave_type6]);
      $a['leave_type7']=floatval($row[leave_type7]);
     array_push($return_arr,$a);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
