<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();


#-------- db query -------#

$bomCode = $_POST["bomCode"];
$procName = $_POST["procName"];
$requan = $_POST["requan"];
$update_query = "update BOM_SPEC set MAST_PROC_NAME='$procName', MAST_PROC_REQUAN='$requan' where BOM_CODE='$bomCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'updateSpec.php', '');
	exit;
} else {
echo 'success';
}

?>
