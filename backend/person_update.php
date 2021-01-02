
 <?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);
 $id = $data['id'];
 $namedetail = $data['namedetail'];
 $occupation = $data['occupation'];
 $location = $data['location'];
 $position = $data['position'];
 $leaveday = $data['leaveday'];


 include 'conn.php';

 
  $query = "UPDATE person
SET name = '" . $namedetail ."',
occupation = '" . $occupation ."',
location = '" . $location ."',
position = '" . $position ."',
leaveday = '" . $leaveday ."'

WHERE id = '" . $id ."' ";








$return_arr = array();

if ($result = mysqli_query( $conn, $query )){
  
  $row_array['message'] = 'แก้ไขข้อมูลสำเร็จ';
  array_push($return_arr,$row_array);
  
 }else{
  $row_array['message'] = 'ไม่สามารถแก้ไขข้อมูลได้';
  array_push($return_arr,$row_array);
 }

mysqli_close($conn);

echo json_encode($return_arr);


?>