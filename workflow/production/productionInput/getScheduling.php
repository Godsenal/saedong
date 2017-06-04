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

$other_que="SELECT PRSS_CODE, PRSS_STAG, MAST_PROD_NAME, PROD_REQUAN, INPU_PROC, GOAL_STAR_TIME, GOAL_FINI_TIME, PROD_QUAN, PROD_DATE, WORK_STAR_TIME, WORK_FINI_TIME
            FROM SCHE_PERF
            WHERE SCHE_CODE='$schedulingCode'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $scheduling_data = mysql_fetch_row($other_result);
  $proc_que = "SELECT MAST_PROC_REQUAN
               FROM BOM_SPEC
               WHERE MAST_PROD_NAME = '$scheduling_data[2]' AND MAST_PROC_NAME = '$scheduling_data[4]'";
  $proc_result=mysql_query($proc_que,$connect);

  $requan = '확인 불가';
  if(mysql_num_rows($proc_result)!=0){
    $proc_data=mysql_fetch_row($proc_result);
    $requan= $scheduling_data[3] * $proc_data[0];
  }


  $data = array('pressCode'=>$scheduling_data[0],
                'pressName'=>$scheduling_data[1],
                'prodName'=>$scheduling_data[2],
                'plan'=>$scheduling_data[3],
                'procName'=>$scheduling_data[4],
                'requan'=>$requan,
                'goalStart'=>$scheduling_data[5],
                'goalFinish'=>$scheduling_data[6],
                'quan'=>$scheduling_data[7],
                'date'=>$scheduling_data[8],
                'start'=>$scheduling_data[9],
                'finish'=>$scheduling_data[10]); //result라는 array에 {planCode:$plan_data[0]} 이런식으로 할당.
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
