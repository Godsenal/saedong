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

$other_que="SELECT * FROM BOM_PROC WHERE MAST_PROC_NAME LIKE '%$procName%'"; // 검색 구문. %s%가 escape string이고 뒤에 %가 like구문에서 myprefix% 이렇게 사용됨.

$other_result=mysql_query($other_que,$connect);
echo mysql_error($connect);
$total = mysql_affected_rows();
$result = array();



for($i = 0; $i < $total; $i++){
  $proc_data = mysql_fetch_row($other_result);
  $data = array('procName'=>$proc_data[0],'stan'=>$proc_data[1],'weig'=>$proc_data[2],'stre'=>$proc_data[3], 'appe'=>$proc_data[4]);

  $result[] = $data;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
