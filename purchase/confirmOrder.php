<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$orderCode = $_POST["orderCode"];
$conf = $_POST["conf"];

#-------- db query -------#

$update_query = 	"update OR_INFO set CONF='$conf'
                  where OR_CODE = '$orderCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'planSearch.html', '');
	exit;
} else {
  echo 'success';
}

?>
