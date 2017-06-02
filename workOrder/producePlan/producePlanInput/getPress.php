<?php
set_time_limit(60);
include "inc_dbconn.inc";

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
#----------------------------------
# database connect
#----------------------------------
init_board();



#----------------------------------
# Select DB Query
#----------------------------------
$prodName = $_GET['prodName'];
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="select PRSS_NAME, MACH_NAME, STAN_TIME from STAN_PRSS WHERE MAST_PROD_NAME = '$prodName'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = "<table class='responsive-table bordered'><thead style='background-color:#333333; color:white'>
            <tr>
              <th>
                공정 명
              </th>
              <th>
                설비 명
              </th>
              <th>
                CYCLE TIME(분)
              </th>
              <th>
                일일 생산량
              </th>
            </tr>
          </thead>
          <tbody>";
for($i = 0; $i < $total; $i++){
  $press_data = mysql_fetch_row($other_result);
  $press_quan = 24*60/$press_data[2];
  $result .= "<tr>
                <td>{$press_data[0]}</td>
                <td>{$press_data[1]}</td>
                <td>{$press_data[2]}</td>
                <td>{$press_quan}</td>
              </tr>";
}
$result .="</tbody></table>";
echo $result;
?>
