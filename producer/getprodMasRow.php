<?php
    #----------------------------------
    # database connect
    #----------------------------------
    set_time_limit(60);
    include "inc_dbconn.inc";
    init_board();
    #----------------------------------


        $connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
        $other_que="SELECT * from SUPP_INFO order by SUPP_CODE";
        $other_result=mysql_query($other_que,$connect);
        $total = mysql_affected_rows();


        for($i = 0; $i < $total; $i++) {
            $code_data = mysql_fetch_row($other_result);
            $supplier_code = $code_data[0];
            $date = $code_data[1];
            $name = $code_data[2];
            $material = $code_data[3];
            $approval = $code_data[4];
            $biz_no = $code_data[5];
            $isApproved = "O";;
            $approvBtn = " - ";
            if(!$approval){
                $isApproved = "X";
                $approvBtn = <<< EOD
<a class='waves-effect waves-light btn' onclick = 'prodApprove("$supplier_code")'>승인</a>
EOD;
            }
            $result .= "<tr>
                        <td>{$supplier_code}</td>
                        <td>{$biz_no}</td>
                        <td>{$name}</td>
                        <td>{$material}</td>
                        <td>{$date}</td>
                        <td id = '{$supplier_code}'>{$isApproved}</td>
                        <td>{$approvBtn}</td>
                        </tr>";
        }
    echo $result;
?>