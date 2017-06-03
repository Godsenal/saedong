<?php
set_time_limit(60);
include "inc_dbconn.inc";

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
#----------------------------------
# database connect
#----------------------------------
init_board();



#----------------------------------
# Select DB Query
#----------------------------------
$prodName = $_GET['prodName'];
$planCode = $_GET['planCode'];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT DISTINCT STAN_PRSS.PRSS_CODE, STAN_PRSS.PRSS_NAME, STAN_PRSS.MAST_PROD_NAME, STAN_PRSS.MAST_PROC_NAME
            FROM STAN_PRSS
            WHERE STAN_PRSS.MAST_PROD_NAME = '$prodName'
            AND NOT EXISTS (SELECT * FROM SCHE_PERF WHERE SCHE_PERF.PRSS_CODE = STAN_PRSS.PRSS_CODE AND SCHE_PERF.PP_CODE = '$planCode')";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $press_data = mysql_fetch_row($other_result);
  $data = array('pressCode'=>$press_data[0],'pressName'=>$press_data[1],'prodName'=>$press_data[2],'procName'=>$press_data[3]); //result라는 array에 {planCode:$plan_data[0]} 이런식으로 할당.
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
