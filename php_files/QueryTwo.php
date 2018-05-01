<?php
include 'config.php';

      $return_arr_f = array(); 
      $sql_f = "SELECT  username, COUNT(follower_id) 
              FROM `user`,`follow` 
              where uid = following_id 
              GROUP BY uid
              Having count(uid) = (SELECT MAX(followercount) 
                                    FROM (SELECT username, COUNT(following_id) as followercount
                                    FROM user, follow
                                    WHERE uid = following_id 
                                    GROUP BY uid) t1)";
      $result_f =$conn->query($sql_f);

       while ($row = $result_f->fetch_assoc()) {
       $row_array_f['username']=$row['username'];
        array_push($return_arr_f,$row_array_f);
      }

    echo json_encode($return_arr_f);
?>
