<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();


#-------- db query -------#

$procName = $_POST["procName"];
$stan = $_POST["stan"];
$weig = $_POST["weig"];
$stre = $_POST["stre"];
$appe = $_POST["appe"];
$ins_query = 	"INSERT into BOM_PROC(MAST_PROC_NAME, MAST_STAN, MAST_WEIG, MAST_STRE, MAST_APPE)
				VALUES('$procName','$stan','$weig','$stre','$appe')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProc.php', '');
	exit;
} else {
echo 'success';
}

?>
