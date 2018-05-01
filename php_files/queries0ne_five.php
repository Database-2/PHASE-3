<?php
include 'config.php';

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
    echo json_encode($return_arr);
  
    ?>

    