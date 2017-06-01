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
$other_que="select PP_CODE from PP_INFO";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = '';
for($i = 0; $i < $total; $i++){
  $plan_data = mysql_fetch_row($other_result);
  if ($result === "") {
      $result = $plan_data[0];
  } else {
      $result .= ",$plan_data[0]";
  }
}
echo $result;
?>
