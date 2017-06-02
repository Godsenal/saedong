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

$result = "<table class='responsive-table bordered centered'><thead style='background-color:#333333; color:white'>
            <tr>
              <th>
                공정 코드
              </th>
              <th>
                제품명
              </th>
              <th>
                계획
              </th>
              <th>
                비고
              </th>
              <th>
                담당자
              </th>
              <th>
                작성일
              </th>
              <th>
                생산예정일
              </th>
              <th>
                승인여부
              </th>
              <th>
                수정
              </th>
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
    if($j == $num_fields -1){
      $isChecked = '';
      $checked = '';
      if($plan_data[$j]){
        $isChecked = 'checked';
        $checked = 'checked = "checked"';
      }
      $result .= <<<CON
      <td><input type='checkbox' id='row$i' $checked onclick='updateConfirm("$plan_data[0]","$isChecked")' /><label for='row$i'></label></td>
CON;
    }else{
      $result .= "<td>{$plan_data[$j]}</td>";
    }

  }
  if($plan_data[$num_fields - 1] == '1'){
    $result .= <<<EOT
    <td><a class='waves-effect waves-light btn disabled' onclick='editPlan("$plan_data[0]","$plan_data[2]","$plan_data[3]","$plan_data[6]")'>수정</a></td>
EOT;
  }
  else{
    $result .= <<<EOF
    <td><a class='waves-effect waves-light btn' onclick='editPlan("$plan_data[0]","$plan_data[2]","$plan_data[3]","$plan_data[6]")'>수정</a></td>
EOF;
  }

  $result .= "</tr>";
}

$result .="</tbody></table>";
echo $result;
?>
