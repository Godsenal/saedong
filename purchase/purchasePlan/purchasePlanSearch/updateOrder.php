<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$orderCode = $_POST["orderCode"];
$quan=$_POST["quan"];
$exDate=$_POST["exDate"];
$reqDate=$_POST["reqDate"];

#-------- db query -------#

$update_query = 	"update OR_INFO set QUAN='$quan',
                    DELI_EX_DATE='$exDate', REQ_DATE='$reqDate'
                  where OR_CODE = '$orderCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'planSearch.html', '');
	exit;
} else {
  echo 'success';
}

?>
