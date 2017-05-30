<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$planCode = $_POST["planCode"];
$plan=$_POST["plan"];
$etc=$_POST["etc"];
$date=$_POST["date"];

#-------- db query -------#

$modify_date = date("Y-m-d");
$update_query = 	"update PP_INFO set PLAN='$plan',
                    PLAN_ETC='$etc', DATE='$date',
                    FINA_MODI_DATE='$modify_date'
                  where PP_CODE = '$planCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'planSearch.html', '');
	exit;
} else {
  echo 'success';
}

?>
