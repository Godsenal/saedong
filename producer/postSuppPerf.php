<?

    set_time_limit(60);
    include "inc_dbconn.inc";
    init_board();

    $suppCode = $_POST['supplierSelected']; 
    $suppQual = $_POST['suppQual'];
    $claim = $_POST['claim'];
    $custumerClaim = $_POST['custumerClaim'];
    $qualGrade = $_POST['qualGrade'];

    $sendPerf = $_POST['sendPerf'];
    $sendFail = $_POST['sendFail'];
    $sendGrade = $_POST['sendGrade'];

    $evalGrade = $_POST['evalGrade'];

    $date = $_POST['date'];
    $writer = $_POST['writer'];

    $etc = $_POST['etc'];

    $ins_query = "INSERT INTO SUPP_MANA_INFO (SUPP_CODE, SUPP_QUAL_INFO, SUPP_IN_INFO, SUPP_EVAL_GRAD, STAF, SUPP_REGI_DATE, INPU_FAIL, CLAI_RATE, CUST_COMP, SEND_PERF, SEND_FAIL, ETC)
                                values       ('$suppCode','$suppQual','$sendGrade' , '$qualGrade','$writer', '$date', '$suppQual','$claim', '$custumerClaim', '$sendPerf', '$sendFail','$etc')";

    $ins_result = mysql_query($ins_query);

    if (!$ins_result) { 
        error_message('DB_ERROR', 'postSuppPerf.php', ''); 
        exit;
    } else {
    echo 	"<script type = 'text/javascript'>
                alert('공급자 코드 : $suppCode, 사업자 등록 번호: $companyNo, 공급자 명 : $name, 자재 정보 : $material, 입력날짜 : $date 등록 완료!');
                window.history.back();
            </script>";
    }

?>