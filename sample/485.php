<?php
  // ������������
  if(ereg("485.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 482.php");
    exit();
  }

  // ���դμ���
  if(!$input_date)
  {
    $query = "SELECT max(modify) FROM " . DIARY_TABLE_LOG;
    $result = @mysql_query($query, $db);
    $num_rows = @mysql_num_rows($result);

    // ����������кǿ������դ򥻥å�
    if($num_rows == 1)
    {
      $input_date = @mysql_result($result, 0, 0);

      if(!preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $input_date))
      {
        $input_date = date("Y-m-d");
      }
    }
    else
    {
      $input_date = date("Y-m-d");
    }
  }

  // �����������ɤ߹���
  include("484.php");

  // �����μ���
  $query = "SELECT * FROM " . DIARY_TABLE_LOG
         . " WHERE modify = '{$input_date}'";
  $result = @mysql_query($query, $db);
  $num_rows = @mysql_num_rows($result);

  if($num_rows == 1)
  {
    $row = @mysql_fetch_assoc($result);
    $title = $row["title"];
    $story = $row["story"];

    // ������ɽ��
    print <<<_EOT_
<table border="0" cellspacing="0" cellpadding="0" width="500">
  <tr>
    <td align="right"><font color="#ff6699">{$input_date}</font></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
  </tr>
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>��{$title}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>{$story}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
</table>\n
_EOT_;
  }
  else
  {
    // �������ʤ��Ȥ�
    print <<<_EOT_
<table border="0" cellspacing="0" cellpadding="0" width="500">
  <tr>
    <td align="right"><font color="#ff6699">{$input_date}</font></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="20" border="0"></td>
  </tr>
  <tr>
    <td align="center">�������������ϵ��Ҥ���Ƥ��ޤ���</td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="20" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
</table>\n
_EOT_;
  }

  // �ʥӥ����������ɤ߹���
  include("486.php");
?>