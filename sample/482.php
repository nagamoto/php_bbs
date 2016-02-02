<?php
  // ����Υ���ݡ���
  require("config.php");

  // �����ѿ������
  $input_mode = ($_GET["mode"]) ? $_GET["mode"] : $_POST["mode"];
  $input_action = ($_GET["action"]) ? $_GET["action"] : $_POST["action"];
  $input_date = ($_GET["date"]) ? $_GET["date"] : $_POST["date"];

  header("Content-Type: text/html; charset=EUC-JP");

  $db = new POD(POD_DSN, DIARY_DB_USER, DIARY_DB_PASS);
//  $db = @mysql_connect(DIARY_DB_HOST, DIARY_DB_USER, DIARY_DB_PASS)
//           or die("Miss Server connecting");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//  @mysql_select_db(DIARY_DB_NAME, $db)
//           or die("Miss DB connecting");

  print <<<_EOT_
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset="EUC-JP">
  <title>482</title>
  <style type="text/css">
    * { font-size: 10pt; }
  </style>
</head>
<body bgcolor="#ffffff" link="#4169e1" alink="#4169e1" vlink="#4169e1">
<center>\n
_EOT_;

  // ɬ�פʥե�����򥤥󥯥롼��
  if(!$input_mode)
  {
    $input_mode = "485";
  }
  include($input_mode . ".php");

  print <<<_EOT_
</center>
</body>
</html>
_EOT_;

  // ����
  mysql_close($db);
?>