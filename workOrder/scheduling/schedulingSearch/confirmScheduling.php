<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$schedulingCode = $_POST["schedulingCode"];
$conf = $_POST["conf"];

#-------- db query -------#

$update_query = 	"update SCHE_PERF set CONF='$conf'
                  where SCHE_CODE = '$schedulingCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'schedulingSearch.html', '');
	exit;
} else {
  echo 'success';
}

?>
