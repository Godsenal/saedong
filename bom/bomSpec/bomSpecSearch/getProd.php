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
$prodName = $_GET["prodName"];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);

$other_que="SELECT *
            FROM BOM_SPEC
            ORDER BY BOM_CODE";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();



for($i = 0; $i < $total; $i++){
  $prod_data = mysql_fetch_row($other_result);
  $data = array('bomCode'=>$prod_data[0],'prodName'=>$prod_data[1],'procName'=>$prod_data[2],'requan'=>$prod_data[3]);

  $result[] = $data;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>
