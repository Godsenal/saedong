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
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT PROD_CODE, MAST_PROD_NAME, PROD_STAN, UNIT, OUTA, STRA, PROB
            FROM PROD_INFO
            WHERE PP_CODE = '$planCode'
            ORDER BY PROD_CODE";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
  $prod_data = mysql_fetch_row($other_result);
  $data = array('prodCode'=>$prod_data[0],
                'prodName'=>$prod_data[1],
                'stan'=>$prod_data[2],
                'unit'=>$prod_data[3],
                'outa'=>$prod_data[4],
                'stra'=>$prod_data[5],
                'prob'=>$prod_data[6]); //result라는 array에 {planCode:$plan_data[0]} 이런식으로 할당.
  $result[] = $data; //push 같은 거
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);// 한글 깨짐 방지
?>
