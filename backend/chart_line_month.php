<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'พักผ่อน' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '1' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '1' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1
union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'ป่วย' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '2' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '2' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1

union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'ลากิจ' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '3' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '3' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1


union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'ราชการ' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '4' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '4' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1

union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'ลาคลอด' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '5' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '5' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1

union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'ลากิจเลี้ยงดูบุตร' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '6' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '6' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1

union all 
SELECT
 (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1 AS years,
'สาย' as leave_type,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '10' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '10' and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_10,
sum(CASE when  DATE_FORMAT(datestart,'%m') = '11' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '11'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_11,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '12' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '12'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_12,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '01' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '01'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_01,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '02' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '02'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_02,
  sum(CASE when  DATE_FORMAT(datestart,'%m') = '03' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '03'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_03,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '04' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '04'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_04,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '05' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '05'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_05,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '06' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '06'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_06,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '07' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '07'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_07,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '08' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '08'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_08,
 sum(CASE when  DATE_FORMAT(datestart,'%m') = '09' and leave_type.id = '7' and  DATEDIFF(leave_add.dateend,leave_add.datestart) = 0 then 1 
 when  DATE_FORMAT(datestart,'%m')= '09'  and leave_type.id = '7' and DATEDIFF(leave_add.dateend,leave_add.datestart) > 0 then DATEDIFF(leave_add.dateend,leave_add.datestart)+1 end) as leave_09
   
 
   
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

GROUP BY  (DATE_FORMAT(CURRENT_DATE,'%Y')+543)+1


  ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
       $a['years']=$row[years];
      $a['name']=$row[leave_type];
 
      $a['data']=array((int)$row[leave_10],(int)$row[leave_11],(int)$row[leave_12],(int)$row[leave_01],(int)$row[leave_02],(int)$row[leave_03]
      ,(int)$row[leave_04],(int)$row[leave_05],(int)$row[leave_06],(int)$row[leave_07],(int)$row[leave_08],(int)$row[leave_09]);
	
      array_push($return_arr,$a);
   }
   
 }

mysqli_close($conn);

echo json_encode($return_arr);








?>
