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
$procName = $_GET['procName'];

$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select SUPP_CODE,MAST_PROC_NAME, SUPP_NAME from SUPP_INFO where MAST_PROC_NAME='$procName'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $producer_data = mysql_fetch_row($other_result);
  $data = array('suppCode'=>$producer_data[0],'procName'=>$producer_data[1],'suppName'=>$producer_data[2]);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
