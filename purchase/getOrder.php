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
$other_que="select * from OR_INFO where MAST_PROC_NAME='$procName'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $proc_data = mysql_fetch_row($other_result);
  $data = array('orderCode'=>$proc_data[0],
  'procName'=>$proc_data[1],
  'planCode'=>$proc_data[2],
  'pri'=>$proc_data[3],
  'suppName'=>$proc_data[4],
  'quan'=>$proc_data[5],
  'exDate'=>$proc_data[6],
  'staff'=>$proc_data[7],
  'reqDate'=>$proc_data[8],
  'conf'=>$proc_data[9],
  'inConf'=>$proc_data[10]);
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
