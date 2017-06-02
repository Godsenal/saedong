<?

set_time_limit(60);
include "inc_dbconn.inc";

#---------------------------------- 
# database connect
#---------------------------------- 
init_board();


$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
$other_que="SELECT MAST_PROC_NAME from BOM_PROC";
$other_result=mysql_query($other_que,$connect);
$total = mysql_affected_rows();
$result = '';
for($i = 0; $i < $total; $i++){
    $mat_data = mysql_fetch_row($other_result);
    if ($result === "") {
        $result = $mat_data[0];
    } else {
        $result .= ",$mat_data[0]";
    }
}
echo $result;

?>