<?
$procCode = $_POST["procCode"];
$procName = $_POST["procName"];
$incomeCode = $_POST["incomeCode"];
$suppName = $_POST["suppName"];
$stan = $_POST["stan"];
$weig = $_POST["weig"];
$stre = $_POST["stre"];
$appe = $_POST["appe"];


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

$fau_query = "SELECT MAST_STAN, MAST_WEIG, MAST_STRE, MAST_APPE FROM BOM_PROC WHERE MAST_PROC_NAME = '$procName'";
$fau_result = mysql_query($fau_query);
$fau_data = mysql_fetch_row($fau_result);

$conf = 1;
$fau_array = array($stan, $weig, $stre, $appe);
for($i =0; $i<count($fau_array); $i++){
	if($fau_array[$i] != $fau_data[$i]){
		$conf = 0;
		break;
	}
}

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
