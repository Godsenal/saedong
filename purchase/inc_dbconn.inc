<?
###############################################################
# Global Valuable define                                      #
###############################################################

# Database connect define

$dbhost = 'localhost';
$default_dbname = 'saedong';
$dbusername = 'saedong';
$dbuserpassword = 'Hufsmis123';

#----------------------------------------------------------
# Function: init_board()
# Description:	database connect
#----------------------------------------------------------


function init_board()
{
	global $default_dbname;
	global $dbhost, $dbusername, $dbuserpassword;
	mysql_connect($dbhost, $dbusername, $dbuserpassword);
	mysql_select_db($default_dbname);
}

#----------------------------------------------------------
# Function: error_message
# Description: 	Error message display
# Argumenst: msg is error type, error_no is userdefine error code.
#----------------------------------------------------------
function error_message($msg, $userid, $error_no)
{
	switch ($msg) {

		case "DB_ERROR" :
			$error_message = mysql_error();
			$msg = "DB error. Report the error to the webmaster. <p>";
			$msg .= $error_message;
			echo "$msg <font color=blue>$userid</font>";
		break;

		case "NO_KEYWORD" :
			$error_message = "검색어를 입력하세요.";
			echo "<script> alert(\"$error_message\"); history.back(); </script>";
		break;

		case "NO_SEARCH_OPTION" :
			$error_message = "검색조건을 선택하세요";
			echo "<script> alert(\"$error_message\"); history.back(); </script>";
		break;

		default :
			$msg = "오류가 발생하였습니다.";
			echo "$msg";
		break;

	}
}

?>
