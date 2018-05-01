<?php
include 'config.php';

    $return_arr_fl = array(); 
    //echo "Count the number that contains the keyword flu?";
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