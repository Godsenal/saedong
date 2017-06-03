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
$procName = $_GET["procName"];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
/*
$other_que="SELECT PROC_INFO.IN_CODE, PROC_INFO.MAST_PROC_NAME, IN_INFO.IN_DATE, COUNT(PROC_INFO.PROC_CODE), (SELECT COUNT(PROC_INFO.PROC_CODE) FROM PROC_INFO WHERE PROC_INFO.CONF = '1' AND PROC_INFO.MAST_PROC_NAME = '$procName' GROUP BY PROC_INFO.IN_CODE), (SELECT COUNT(PROC_INFO.PROC_CODE) FROM PROC_INFO WHERE PROC_INFO.CONF='0' AND PROC_INFO.MAST_PROC_NAME = '$procName' GROUP BY PROC_INFO.IN_CODE) FROM PROC_INFO, IN_INFO
WHERE PROC_INFO.MAST_PROC_NAME = '$procName' AND IN_INFO.IN_CODE = PROC_INFO.IN_CODE GROUP BY PROC_INFO.IN_CODE";



$other_result=mysql_query($other_que,$connect);
*/
$other_que="SELECT PROC_INFO.IN_CODE, PROC_INFO.MAST_PROC_NAME, IN_INFO.IN_DATE from PROC_INFO, IN_INFO WHERE IN_INFO.IN_CODE=PROC_INFO.IN_CODE AND PROC_INFO.MAST_PROC_NAME = '$procName' GROUP BY PROC_INFO.IN_CODE";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();



for($i = 0; $i < $total; $i++){
  //$seek = mysql_data_seek($other_result,$i); // 지정된 장소로 pointer를 이동.
  $proc_data = mysql_fetch_row($other_result); // 반환한 후 포인터를 다음 row로 이동시킴.
  $sub_que="SELECT COUNT(PROC_CODE) FROM PROC_INFO WHERE IN_CODE = '$proc_data[0]' GROUP BY IN_CODE";
  $sub_que1="SELECT COUNT(PROC_CODE) FROM PROC_INFO WHERE CONF = '1' AND IN_CODE = '$proc_data[0]' GROUP BY IN_CODE";
  $sub_que2="SELECT COUNT(PROC_CODE) FROM PROC_INFO WHERE CONF = '0' AND IN_CODE = '$proc_data[0]' GROUP BY IN_CODE";
  $sub_que3="SELECT COUNT(PROC_CODE) FROM PROC_INFO WHERE USED = '1' AND IN_CODE = '$proc_data[0]' GROUP BY IN_CODE";
  $sub_result=mysql_query($sub_que,$connect);
  $count=0;
  $goodCount=0;
  $badCount=0;
  $usedCount =0;
  /*에러 처리*/
  if(mysql_num_rows($sub_result)>0){
    $count = mysql_result($sub_result,0);
  }

  $sub1_result=mysql_query($sub_que1,$connect);
  if(mysql_num_rows($sub1_result)>0){
    $goodCount = mysql_result($sub1_result,0);
  }


  $sub2_result=mysql_query($sub_que2,$connect);
  if(mysql_num_rows($sub2_result)>0){
    $badCount = mysql_result($sub2_result,0);
  }

  $sub3_result=mysql_query($sub_que3,$connect);
  if(mysql_num_rows($sub3_result)>0){
    $usedCount = mysql_result($sub3_result,0);
  }


  $data = array('incomeCode'=>$proc_data[0],'procName'=>$proc_data[1],'inDate'=>$proc_data[2],'count'=>$count,'goodCount'=>$goodCount, 'badCount'=>$badCount, 'usedCount'=>$usedCount);

  $result[] = $data;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
