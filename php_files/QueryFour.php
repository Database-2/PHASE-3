<?php
include 'config.php';

   $search = $user_name ="";
     $return_arr = array();
if(isset($_POST['user_s'])){
   $user_name = $_POST['user_s'];
  }
if(isset($_POST['submit_search'])){
$search = $_POST['submit_search'];
}
   // if ($search) {
      $sql = "SELECT body
              FROM `user`,`twitts` 
              WHERE user.uid =  twitts.uid AND username LIKE '$user_name%' 
              GROUP BY post_time DESC";

      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        $row_array['body']=$row["body"];
         array_push($return_arr,$row_array);
       // echo '<br />';
      }
      echo json_encode($return_arr);
     } else {
      echo "No result";
     }
 //  }   

?>