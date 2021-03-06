<?php
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();



#----------------------------------
# Select DB Query
#----------------------------------
$schedulingCode = $_GET["schedulingCode"];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);

$other_que="SELECT PRSS_CODE, PRSS_STAG, MAST_PROD_NAME, PROD_QUAN, INPU_PROC, PROD_DATE, WORK_STAR_TIME, WORK_FINI_TIME
            FROM SCHE_PERF
            WHERE SCHE_CODE='$schedulingCode'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $scheduling_data = mysql_fetch_row($other_result);
  $data = array('pressCode'=>$scheduling_data[0],
                'pressName'=>$scheduling_data[1],
                'prodName'=>$scheduling_data[2],
                'quan'=>$scheduling_data[3],
                'procName'=>$scheduling_data[4],
                'date'=>$scheduling_data[5],
                'start'=>$scheduling_data[6],
                'finish'=>$scheduling_data[7]); //result라는 array에 {planCode:$plan_data[0]} 이런식으로 할당.
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
