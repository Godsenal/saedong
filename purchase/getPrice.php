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
$suppCode = $_GET['suppCode'];
$procName = $_GET['procName'];

$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select PRI_CODE,PRI from PRI_INFO where SUPP_CODE='$suppCode' AND MAST_PROC_NAME='$procName'"; // AND는 대문자로..

/*불량률 구하는 query*/
$countAll_que="select count(*) from PROC_INFO where SUPP_CODE='$suppCode' AND MAST_PROC_NAME='$procName'"; // 모든 자재 갯수
$countDefect_que="select count(*) from PROC_INFO where SUPP_CODE='$suppCode' AND MAST_PROC_NAME='$procName' AND CONF='0'"; // 입고 불량난 자재 개수
$countAll_result=mysql_query($countAll_que,$connect);
$countDefect_result=mysql_query($countDefect_que,$connect);
$defect = mysql_result($countDefect_result,0)/mysql_result($countAll_result,0); // 0번째 row(count는 하나니까 이게 빠름)
/*불량률 구하는 query*/

$other_result=mysql_query($other_que,$connect);

$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $pri_data = mysql_fetch_row($other_result);
  $data = array('priCode'=>$pri_data[0],'pri'=>$pri_data[1],'defect'=>$defect);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
