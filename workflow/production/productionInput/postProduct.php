<?
$prodCode = $_POST["prodCode"];
$prodName = $_POST["prodName"];
$procName = $_POST["procName"];
$planCode=$_POST["planCode"];
$stan=$_POST["stan"];
$unit=$_POST["unit"];
$outa=$_POST["outa"];
?>

<?
set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

?>



<?
#-------- db query -------#
$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);

/*제품에 자재 몇개들어가는지 확인 */
$proc_que = "SELECT MAST_PROC_REQUAN
						 FROM BOM_SPEC
						 WHERE MAST_PROD_NAME = '$prodName' AND MAST_PROC_NAME = '$procName'";
$proc_result=mysql_query($proc_que,$connect);
$requan = 0;
if(mysql_num_rows($proc_result)!=0){
	$proc_data=mysql_fetch_row($proc_result);
	$requan = intval($proc_data[0]);
}
/*자재 테이블에서 사용된 자재만큼 업데이트 */
$update_query = "UPDATE PROC_INFO
								 SET USED='1'
								 WHERE MAST_PROC_NAME = '$procName' AND CONF='1' AND USED='0'
								 ORDER BY PROC_CODE
								 LIMIT $requan";

$update_result = mysql_query($update_query, $connect);

echo mysql_error( $connect);
/*제품 등록 */
$ins_query = 	"INSERT into PROD_INFO(PROD_CODE, MAST_PROD_NAME, PP_CODE, PROD_STAN, UNIT, OUTA)
				VALUES('$prodCode','$prodName','$planCode','$stan','$unit','$outa')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProduct.php', '');
	exit;
} else {
echo 'success';
}

?>
