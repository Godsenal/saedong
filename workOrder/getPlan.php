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
$other_que="select * from PP_INFO WHERE MAST_PROD_NAME = '$prodName'";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$num_fields = mysql_num_fields($other_result);

$result = "<table class='responsive-table bordered'><thead style='background-color:#333333; color:white'>
            <tr>
              <td>
                공정 코드
              </td>
              <td>
                제품명
              </td>
              <td>
                계획
              </td>
              <td>
                비고
              </td>
              <td>
                담당자
              </td>
              <td>
                날짜
              </td>
              <td>
                마지막 수정일
              </td>
              <td>
                수정
              </td>
            </tr>
          </thead>
          <tbody>";

/*  동적으로 field 이름 받아와서 넣기.
$result= "<table class='responsive-table bordered'><thead style='background-color:#333333; color:white'><tr>";
for($i=0; $i<$num_fields; $i++){
  $field_name = mysql_field_name($other_result,$i);
  $result .= "<td>{$field_name}</td>";
}
$result .= "</tr></thead><tbody>";
*/
for($i = 0; $i < $total; $i++){
  $plan_data = mysql_fetch_row($other_result);
  $result .= "<tr>";
  for($j = 0; $j< $num_fields; $j++){
    $result .= "<td>{$plan_data[$j]}</td>";
  }
  $result .= "<td><a class='waves-effect waves-light btn' id={$plan_data[0]} onclick='editPlan(this.id)'><i class='material-icons left'>edit</i>수정</a></td>";
  $result .= "</tr>";
}

$result .="</tbody></table>";
echo $result;
?>
