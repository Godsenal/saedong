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
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select OR_CODE,MAST_PROC_NAME from OR_INFO where CONF='1'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $proc_data = mysql_fetch_row($other_result);
  $data = array('orderCode'=>$proc_data[0],'procName'=>$proc_data[1]);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
