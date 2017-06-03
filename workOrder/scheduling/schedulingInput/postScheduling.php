<?
$schedulingCode = $_POST["schedulingCode"];
$prodname = $_POST["prodName"];
$pressCode = $_POST["pressCode"];
$planCode = $_POST["planCode"];
$goalStart = $_POST["goalStart"];
$goalFinish = $_POST["goalFinish"];
$date=date("Y-m-d");
$staff=$_POST["staff"];
$conf=1;
$pressName = $_POST["pressName"];
$plan=$_POST["plan"];
$procName=$_POST["procName"];



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

$ins_query = 	"INSERT into SCHE_PERF(SCHE_CODE, MAST_PROD_NAME, PRSS_CODE, PP_CODE, GOAL_STAR_TIME, GOAL_FINI_TIME, DATE, STAF, CONF, PRSS_STAG, PROD_REQUAN, INPU_PROC)
				VALUES('$schedulingCode','$prodname','$pressCode','$planCode','$goalStart','$goalFinish','$date','$staff','$conf','$pressName','$plan','$procName')";

$connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);

$ins_result = mysql_query($ins_query);
echo mysql_error( $connect);
if (!$ins_result) {
	error_message('DB_ERROR', 'postScheduling.php', '');
	exit;
} else {
echo 'success';
}

?>
