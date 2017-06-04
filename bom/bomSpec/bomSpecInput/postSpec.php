<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();


#-------- db query -------#

$bomCode = $_POST["bomCode"];
$prodName = $_POST["prodName"];
$procName = $_POST["procName"];
$requan = $_POST["requan"];




$ins_query = 	"INSERT into BOM_SPEC(BOM_CODE, MAST_PROD_NAME, MAST_PROC_NAME, MAST_PROC_REQUAN)
				VALUES('$bomCode','$prodName','$procName','$requan')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postSpec.php', '');
	exit;
} else {
echo 'success';
}

?>
