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
$planCode = $_GET['planCode'];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT MAST_PROD_NAME, PLAN, PROD_EX_DATE, STAF, PLAN_ETC  FROM PP_INFO WHERE PP_CODE = '$planCode' AND CONF = '1'";
$other_result=mysql_query($other_que,$connect);
$plan_data = mysql_fetch_row($other_result);

$proc_que="SELECT MAST_PROC_NAME, MAST_PROC_REQUAN FROM BOM_SPEC WHERE MAST_PROD_NAME = '$plan_data[0]'";
$proc_result=mysql_query($proc_que,$connect);
$total = mysql_affected_rows();
$isIn = 1;
for($i=0; $i<$total; $i++){
  $proc_data = mysql_fetch_row($proc_result);
  $stock_que = "SELECT COUNT(PROC_CODE) FROM PROC_INFO WHERE CONF='1' AND USED='0' AND MAST_PROC_NAME='$proc_data[0]'";
  $stock_result=mysql_query($stock_que,$connect);
  $stockCount = 0;
  if(mysql_num_rows($stock_result)>0){
    $stockCount = mysql_result($stock_result,0);
  }
  /*stock이 plan에 요구되는만큼 남아있는지 */
  if($proc_data[1] * $plan_data[1] > $stockCount){
    $isIn = 0;
    break;
  }
}

$result = array('planCode'=>$planCode,'prodName'=>$plan_data[0],'plan'=>$plan_data[1],'isIn'=>$isIn, 'exDate'=>$plan_data[2],'staff'=>$plan_data[3],'etc'=>$plan_data[4]);

echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
