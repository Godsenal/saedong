<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$schedulingCode = $_POST["schedulingCode"];
$quan=$_POST["quan"];
$date=$_POST["date"];
$start=$_POST["start"];
$finish=$_POST["finish"];

#-------- db query -------#

$update_query = 	"UPDATE SCHE_PERF
                   SET PROD_QUAN='$quan', PROD_DATE='$date', WORK_STAR_TIME='$start', WORK_FINI_TIME='$finish'
                   WHERE SCHE_CODE = '$schedulingCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'updateScheduling.php', '');
	exit;
} else {
  echo 'success';
}

?>
