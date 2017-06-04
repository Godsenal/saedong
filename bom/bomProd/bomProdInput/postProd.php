<?php



set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();


#-------- db query -------#

$prodName = $_POST["prodName"];
$ins_query = 	"INSERT into BOM_PROD(MAST_PROD_NAME)
				VALUES('$prodName')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProd.php', '');
	exit;
} else {
echo 'success';
}

?>
