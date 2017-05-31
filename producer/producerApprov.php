<?
    #----------------------------------
    # database connect
    #----------------------------------
    set_time_limit(60);
    include "inc_dbconn.inc";
    init_board();
    #----------------------------------
    $suppCode = $_GET['suppCode'];

    $sqlQuery = "UPDATE SUPP_INFO SET SUPP_INFO.CONF=1 WHERE SUPP_INFO.SUPP_CODE = '$suppCode'";
    
    $result = mysql_query($sqlQuery);

    echo $result;
?>