<?php
include 'config.php';

// 1
    echo "What is trending?";
    echo "The post that has the most number of likes.";
    $return_arr = array(); 
      $sql = "SELECT body, COUNT(thumb.tid) 
              FROM twitts, thumb
              WHERE twitts.tid = thumb.tid
              GROUP BY body
              Having count(thumb.tid) = (SELECT MAX(thumbcount) FROM
                                        (SELECT body, COUNT(thumb.tid) as thumbcount
                                         FROM twitts, thumb
                                         WHERE twitts.tid = thumb.tid 
                                         GROUP BY body) t1)";

      $result =$conn->query($sql);

      while ($row = $result->fetch_assoc()) {
       $row_array['body']=$row['body'];
        array_push($return_arr,$row_array);
      }

// 2
    echo json_encode($return_arr);
     echo " ";
   echo "Who has the most twitter follwers?";    
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

    // 3
    $return_arr_fl = array(); 
    echo "Count the number that contains the keyword flu?";
      $sql_fl = "SELECT COUNT(body), location
              FROM `twitts`, `user`
              WHERE twitts.uid = user.uid AND `body` LIKE '%flu%'
              GROUP BY location";

      $result_fl =$conn->query($sql_fl);

      while ($row = $result_fl->fetch_assoc()) {
        $row_array_fl['count'] = $row["COUNT(body)"];
        $row_array_fl['location'] = $row["location"] ;
        array_push($return_arr_fl,$row_array_fl);
      }
      echo json_encode($return_arr_fl);

    ?>

  

    <!-- 4 -->  
    <!-- User input a person’s twitter name, find all the posts made by that person  -->

            
    <?php
    $search = $user_name ="";
    $return_arr_s = array(); 
    if(isset($_POST['user_s'])){
    $user_name = $_POST['user_s'];
    }
    if(isset($_POST['submit_search'])){
    $search = $_POST['submit_search'];
    }
    //if ($search) {
      $sql_s = "SELECT body
              FROM `user`,`twitts` 
              WHERE user.uid =  twitts.uid AND username LIKE '$user_name%' 
              GROUP BY post_time DESC";

      $result_s =$conn->query($sql_s);

      while ($row = $result_s->fetch_assoc()) {
        $row_array_s['body'] = $row["body"] ;
        //echo '<br />';
        array_push($return_arr_s,$row_array_s);
      }
      echo json_encode($return_arr_s);

  // }          
   
    ?> 