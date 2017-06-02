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
$other_que="select MAST_PROD_NAME from BOM_PROD";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = '';
for($i = 0; $i < $total; $i++){
  $prod_data = mysql_fetch_row($other_result);
  if ($result === "") {
      $result = $prod_data[0];
  } else {
      $result .= ",$prod_data[0]";
  }
}
echo $result;
?>
