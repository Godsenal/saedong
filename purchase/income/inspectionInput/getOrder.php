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
$orderCode = $_GET["orderCode"];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select MAST_PROC_NAME,SUPP_NAME from OR_INFO where OR_CODE='$orderCode'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $order_data = mysql_fetch_row($other_result);
  $data = array('procName'=>$order_data[0],'suppName'=>$order_data[1]);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
