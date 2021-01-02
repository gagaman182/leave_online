
 <?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);
 $id = $data['id'];
 $person_name = $data['person_name_select'];
 $leave_type = $data['leave_type'];
 $datestart = $data['datestart'];
 $dateend = $data['dateend'];
 $halfday = $data['halfday'];

 include 'conn.php';

 
  $sql = "UPDATE leave_add
SET person_name = '" . $person_name ."',
leave_type = '" . $leave_type ."',
datestart = '" . $datestart ."',
dateend = '" . $dateend ."',

edittime = CURRENT_TIMESTAMP,
halfday = '" . $halfday ."'

WHERE id = '" . $id ."' ";





$return_arr = array();

if ($conn->query($sql) === TRUE) {
	
	
		$row_array['message'] = "แก้ไขข้อมูลสำเร็จ";
		array_push($return_arr,$row_array);
	
        
        
	
} else {
	$row_array['message'] =  "ไม่สามารถแก้ไขข้อมูลได้ " ;
	array_push($return_arr,$row_array);
}


mysqli_close($conn);

echo json_encode($return_arr);


?>