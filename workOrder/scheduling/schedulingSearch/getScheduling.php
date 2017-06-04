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
$planCode = $_GET["planCode"];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT SCHE_CODE, PRSS_STAG, PROD_REQUAN, GOAL_STAR_TIME, GOAL_FINI_TIME, CONF
            FROM SCHE_PERF
            WHERE PP_CODE='$planCode'
            ORDER BY PRSS_CODE";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $scheduling_data = mysql_fetch_row($other_result);
  $data = array('schedulingCode'=>$scheduling_data[0],
                'pressName'=>$scheduling_data[1],
                'plan'=>$scheduling_data[2],
                'goalStart'=>$scheduling_data[3],
                'goalFinish'=>$scheduling_data[4],
                'conf'=>$scheduling_data[5]); //result라는 array에 {planCode:$plan_data[0]} 이런식으로 할당.
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
