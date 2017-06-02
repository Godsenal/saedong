<?
$incomeCode = $_POST["incomeCode"];
$orderCode = $_POST["orderCode"];
$incomeCount = $_POST["incomeCount"];
$incomeDate = $_POST["incomeDate"];
$staff = $_POST["staff"];
$conf = $_POST["conf"];
$etc = $_POST["etc"];

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

$ins_query = 	"INSERT into IN_INFO(IN_CODE, OR_CODE, CONF, IN_DATE, QUAN, STAF, ETC)
				VALUES('$incomeCode','$orderCode','$conf','$incomeDate','$incomeCount','$staff','$etc')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postIncome.php', '');
	exit;
} else {
echo 'success';
}

?>
