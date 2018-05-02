<?php
include 'config.php';
  $year ="";
  $year_list="";
   $return_arr_f = array();
   $return_arr_e = array();
  if(isset($_POST['submit'])){
      $year = $_POST['submit'];
    }
    if(isset($_POST['yearlist'])){
      //$year_list
$year_list= $_POST['yearlist'];
}
        $sql = "SELECT username, COUNT(twitts.uid)
                FROM `user`,`twitts` 
                WHERE user.uid =  twitts.uid AND twitts.post_time LIKE '$year_list%'
                GROUP BY twitts.uid
                HAVING COUNT(twitts.uid) = (SELECT MAX(twittscount) from
                                            (SELECT COUNT(twitts.uid) as twittscount      
                                            FROM twitts, user
                                            WHERE twitts.uid = user.uid 
                                            GROUP BY twitts.uid) t1)";

      $result =$conn->query($sql);

    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        $row_array_f['username']=$row['username'];
        array_push($return_arr_f,$row_array_f);

     }
    echo json_encode($return_arr_f);
      //  exit();
   }else{
      echo "Please select another year";
     //$row_array_ee['username_eer']= array("one");
     //array_push($return_arr_e,$row_array_ee);
    //echo json_encode($return_arr_e);

    }           
?>