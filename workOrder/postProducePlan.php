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

$ins_query = 	"insert into PP_INFO (PP_CODE, MAST_PROD_NAME, PLAN, PLAN_ETC, STAF, DATE, PROD_EX_DATE, CONF)
				values ('$code','$prodname','$plan','$etc','$staff','$date','$exDate','false')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) {
	error_message('DB_ERROR', 'postProducePlan.php', '');
	exit;
} else {
echo 	"<script type = 'text/javascript'>
			alert('생산계획 코드: $code, 제품명: $prodname, 계획: $plan, 비고: $etc, 담당자: $staff, 생산계획일: $exDate, 정보가 날짜: $date 에'
			+' 등록이 완료되었습니다.');
			window.history.back();
		</script>";
}

?>
