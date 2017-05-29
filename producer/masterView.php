<html>
<title>회원정보 조회</title>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="content-type" content=" text/html; charset=utf-8">
    <link type="text/css" content="width=device-width, initial-scale=1.0" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
<div id ="container">
  <?
  #----------------------------------
  # database connect
  #----------------------------------
  set_time_limit(60);
  include "inc_dbconn.inc";
  init_board();
  #------------------------------------
  ?>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  <table class="responsive-table bordered" >
  <script type = "text/javascript">
    function approve(itemkey){
      <?php
        $ins_query = "select * PR_SUPPLIER approval"
      ?>
    }
  </script>
    <thead style=" background-color:#333333; color:white">
      <tr>
        <td>
          Supplier Code
        </td>
        <td>
          공급자 명
        </td>
        <td>
          자재 명
        </td>
        <td>
          연락처
        </td>
        <td>
          작성일
        </td>
        <td>
          승인여부
        </td>
        <td>
          승인
        </td>
      </tr>
    </thead>
    <tbody>
  <?
    #----------------------------------
    # Select DB Query
    #----------------------------------
    $connect = mysql_connect($dbhost, $dbusername, $dbuserpassword);
    $other_que="select * from PR_SUPPLIER order by name";
    $other_result=mysql_query($other_que,$connect);
    $total = mysql_affected_rows();
    for($i = 0; $i < $total; $i++) {
      $code_data = mysql_fetch_row($other_result);
      $supplier_code = $code_data[0];
      $name = $code_data[1];
      $material = $code_data[2];
      $tel = $code_data[3];
      $date = $code_data[4];
      $approval = $code_data[5];
      $isApproved = 'X';
      $approvBtn = ' - ';
      if($approval)
        $isApproved  = 'O';
        $approvBtn = '<button type = "button" onclick = "approve($i)">승인</button>';
      echo ("
        <tr>
          <td>$supplier_code</td>
          <td>$name</td>
          <td>$material</td>
          <td>$tel</td>
          <td>$date</td>
          <td>$isApproved</td>
          <td>$approvBtn</td>
      ");
      echo ("</tr>");
    }
  ?>
  </tbody>
  </table>
</div>
</body>
</html>
