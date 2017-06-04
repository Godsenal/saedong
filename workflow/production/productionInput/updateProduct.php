<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

$prodCode = $_POST["prodCode"];
$type=$_POST["type"];
$value=$_POST["value"];


#-------- db query -------#

$update_query = 	"UPDATE PROD_INFO ";
switch ($type) {
  case 'outa':
    $update_query .= "SET OUTA='$value'";
    break;

  case 'stra':
    $update_query .= "SET STRA='$value'";
    break;

  case 'prob':
    $update_query .= "SET PROB='$value'";
    break;

  default:
    $update_query .= "SET STRA='$value'";
    break;
}
$update_query .= "WHERE PROD_CODE = '$prodCode'";

$update_result = mysql_query($update_query);


if (!$update_result) {
	error_message('DB_ERROR', 'updateProduct.php', '');
	exit;
} else {
  echo 'success';
}

?>
