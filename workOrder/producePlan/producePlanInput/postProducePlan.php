<?
$code = $_POST["code"];
$prodname = $_POST["prodName"];
$plan=$_POST["plan"];
$etc=$_POST["etc"];
$staff=$_POST["staff"];
$date=date("Y-m-d");
$exDate=$_POST["exDate"];

?>

<?
set_time_limit(60);
include "inc_dbconn.inc";

#----------------------------------
# database connect
#----------------------------------
init_board();

?>



<?
#-------- db query -------#

$ins_query = 	"INSERT into PP_INFO(PP_CODE, MAST_PROD_NAME, PLAN, PLAN_ETC, STAF, DATE, PROD_EX_DATE, CONF)
				VALUES('$code','$prodname','$plan','$etc','$staff','$date','$exDate','0')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProducePlan.php', '');
	exit;
} else {
echo 'success';
}

?>
