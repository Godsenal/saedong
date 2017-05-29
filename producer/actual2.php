
<?
$suppCode = $_POST["suppCode"]
$name=$_POST["name"];
$date=$_POST["date"];
$material=$_POST["material"];

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

$ins_query = 	"insert into SUPP_INFO (SUPP_CODE, SUPP_REGI_DATE, SUPP_NAME, SUPP_PROC_INFO) 
				values ('$suppCode','$date','$name','$material')";

$ins_result = mysql_query($ins_query);

if (!$ins_result) { 
	error_message('DB_ERROR', 'actual2.php', ''); 
	exit;
} else {
echo 	"<script type = 'text/javascript'>
			alert('공급자 코드 : $suppCode, 공급자이름 : $name, 자재명 : $material, 입력날짜 : $date \n 공급자 $name의 등록이 완료되었습니다.');
			window.history.back();
		</script>";
}

?>

