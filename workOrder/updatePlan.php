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
$exDate=$_POST["exDate"];

#-------- db query -------#

$update_query = 	"update PP_INFO set PLAN='$plan',
                    PLAN_ETC='$etc', PROD_EX_DATE='$exDate'
                  where PP_CODE = '$planCode'";

$update_result = mysql_query($update_query);

if (!$update_result) {
	error_message('DB_ERROR', 'planSearch.html', '');
	exit;
} else {
  echo 'success';
}

?>
