<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

    $monthstart = $_GET["monthstart"];
    $monthend = $_GET["monthend"];
    // $monthstart = "2020-10";
    // $monthend = "2020-11";

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
  sum(person.leaveday-CASE when  leave_type.id = '1'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '1'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type1_total,
   sum(CASE when  leave_type.id = '1'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '1'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type1,
  sum(CASE when  leave_type.id = '2'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '2'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type2,
  sum(CASE when  leave_type.id = '3'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '3'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type3,
  sum(CASE when  leave_type.id = '4'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '4'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type4,
  sum(CASE when  leave_type.id = '5'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '5'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type5,
  sum(CASE when  leave_type.id = '6'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '6'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type6,
  sum(CASE when  leave_type.id = '7'  and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
  when  leave_type.id = '7'   and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_type7
  
  FROM
   person
  INNER JOIN leave_add ON person.id = leave_add.id_person
  INNER JOIN leave_type on leave_add.leave_type = leave_type.id
 
  where left(leave_add.datestart,7) >= '".$monthstart."' and left(leave_add.dateend,7) <= '".$monthend."'
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
      $a['leave_type1_total']=intval($row[leave_type1_total]);
      $a['leave_type1']=intval($row[leave_type1]);
      $a['leave_type2']=intval($row[leave_type2]);
      $a['leave_type3']=intval($row[leave_type3]);
      $a['leave_type4']=intval($row[leave_type4]);
      $a['leave_type5']=intval($row[leave_type5]);
      $a['leave_type6']=intval($row[leave_type6]);
      $a['leave_type7']=intval($row[leave_type7]);
     array_push($return_arr,$a);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
