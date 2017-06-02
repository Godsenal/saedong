
<?
$suppCode = $_POST["suppCode"];
$companyNo = $_POST["companyNo"];
$name=$_POST["name"];
$material=$_POST["material"];
$date=$_POST["date"];

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

$ins_query = 	"INSERT INTO SUPP_INFO (SUPP_CODE, SUPP_REGI_DATE, SUPP_NAME, SUPP_PROC_INFO, CONF, BIZN) 
				values ('$suppCode','$date','$name','$material', '0', '$companyNo')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) { 
	error_message('DB_ERROR', 'actual2.php', ''); 
	exit;
} else {
echo 	"<script type = 'text/javascript'>
			alert('공급자 코드 : $suppCode, 사업자 등록 번호: $companyNo, 공급자 명 : $name, 자재 정보 : $material, 입력날짜 : $date 등록 완료!');
			window.history.back();
		</script>";
}

?>

