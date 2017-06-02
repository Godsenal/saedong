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
$prodName = $_GET['prodName'];

$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select MAST_PROC_NAME,MAST_PROC_REQUAN from BOM_SPEC where MAST_PROD_NAME='$prodName'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $proc_data = mysql_fetch_row($other_result);
  $data = array('procName'=>$proc_data[0],'procRequan'=>$proc_data[1]);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
