<?php
 header('Content-Type:application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
 $data = json_decode(file_get_contents('php://input'),true);

 $person_name = $data['person_name_select'];
 $leave_type = $data['leave_type'];
 $datestart = $data['datestart'];
 $dateend = $data['dateend'];
 $halfday = $data['halfday'];


include 'conn.php';





 // หา record ล่าสุด
// $sql = "SELECT count(*) as total from leave_add";
 
// if ($result = mysqli_query( $conn, $sql )){
  
//    while ($row = mysqli_fetch_assoc($result)) {

//      $id=$row['total']+1;
//  }
// }

//หา id person
$sql2 = "SELECT id as ids from person where name like '%".$person_name."%' ";
 
if ($result2 = mysqli_query( $conn, $sql2 )){
  
   while ($row_id = mysqli_fetch_assoc($result2)) {

     $id_person=$row_id['ids'];
 }
}

if (!empty($person_name)) {
 

    
       $strvisit  = "  INSERT INTO leave_add(id_person,person_name,leave_type,datestart,dateend,dupdate,halfday) 
        VALUES('".$id_person."','".$person_name."','".$leave_type."','".$datestart."','".$dateend."',CURRENT_TIMESTAMP,'".$halfday."')";
        
        
        
        if ($conn->query($strvisit) === TRUE) {
          
            
            $return_message = array();
            $row_array['message'] = "เพิ่มข้อมูลสำเร็จ";
            array_push($return_message,$row_array);
        
        
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $return_message = array();
            $row_array['message'] = "เพิ่มข้อมูลไม่สำเร็จ";
            array_push($return_message,$row_array);
            
        }


      }
      
mysqli_close($conn);
	
echo json_encode($return_message);

?>