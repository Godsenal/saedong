<?
$orderCode = $_POST["orderCode"];
$procName = $_POST["procName"];
$planCode=$_POST["planCode"];
$priCode=$_POST["priCode"];
$suppCode=$_POST["suppCode"];
$quan=$_POST["quan"];
$exDate=$_POST["exDate"];
$reqDate=$_POST["reqDate"];
$staff=$_POST["staff"];
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

$ins_query = 	"INSERT into OR_INFO(OR_CODE, MAST_PROC_NAME, PP_CODE, PRI_CODE, SUPP_CODE, QUAN, DELI_EX_DATE, STAF, REQ_DATE, CONF, IN_CONF)
				VALUES('$orderCode','$procName','$planCode','$priCode','$suppCode','$quan','$exDate','$staff','$reqDate','0','0')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postPurchasePlan.php', '');
	exit;
} else {
echo 'success';
}

?>
