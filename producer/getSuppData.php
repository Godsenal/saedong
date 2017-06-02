<?

set_time_limit(60);
include "inc_dbconn.inc";

#---------------------------------- 
# database connect
#---------------------------------- 
init_board();


$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT SUPP_INFO.SUPP_CODE, SUPP_INFO.MAST_PROC_NAME, SUPP_INFO.SUPP_NAME FROM SUPP_INFO";
$other_result = mysql_query($other_que, $connect);
$total = mysql_affected_rows();
$result = array();
for($i = 0; $i < $total; $i++){
    $supp_data = mysql_fetch_row($other_result);
    $data = array('suppCode'=>$supp_data[0], 'suppName'=>$supp_data[2], 'procName'=>$supp_data[1]);
    $result[] = $data;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>