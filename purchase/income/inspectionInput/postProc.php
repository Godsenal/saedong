<?
$procCode = $_POST["procCode"];
$procName = $_POST["procName"];
$incomeCode = $_POST["incomeCode"];
$suppName = $_POST["suppName"];
$stan = $_POST["stan"];
$weig = $_POST["weig"];
$stre = $_POST["stre"];
$appe = $_POST["appe"];
$conf = $_POST["conf"];


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

$ins_query = 	"INSERT into PROC_INFO(PROC_CODE, MAST_PROC_NAME, IN_CODE, SUPP_NAME, STAN, WEIG, STRE, APPE, CONF)
				VALUES('$procCode','$procName','$incomeCode','$suppName','$stan','$weig','$stre','$appe','$conf')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProc.php', '');
	exit;
} else {
echo 'success';
}

?>
