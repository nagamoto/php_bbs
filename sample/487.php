<?php
  // ���å���󳫻�
  session_name("DIARY");
  session_start();

  // ������ɤ߹���
  require("config.php");

  // �ѿ���Ÿ��
  $input_mode = ($_GET["mode"]) ? $_GET["mode"] : $_POST["mode"];
  $input_action = ($_GET["action"]) ? $_GET["action"] : $_POST["action"];
  $input_date = ($_GET["date"]) ? $_GET["date"] : $_POST["date"];

  // �إå��ν���
  header("Content-Type: text/html; charset=EUC-JP");

  // �ǡ����١�������³
  $db = @mysql_connect(DIARY_DB_HOST, DIARY_DB_USER, DIARY_DB_PASS)
           or die("�����ƥ२�顼�Ǥ��������Ԥ�Ϣ���Ƥ���������");
  @mysql_select_db(DIARY_DB_NAME, $db)
           or die("�����ƥ२�顼�Ǥ��������Ԥ�Ϣ���Ƥ���������");

  // ��������
  if($input_action == "logout")
  {
    // ǧ�ڥơ��֥����Ͽ�������å�������
    $query = "DELETE FROM " . DIARY_TABLE_AUTH
           . " WHERE uid = '" . $_SESSION["uid"] . "'"
           . " AND sid = '" . md5(session_id()) . "'";
    @mysql_query($query, $db);

    // ���å������˴�
    $_SESSION = array();
    session_destroy();
    header("Location: 482.php?date={$input_date}");
    exit();
  }

  // �桼����ǧ��
  include("488.php");

  // �ڡ�����ɽ��
  print <<<_EOT_
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset="EUC-JP">
  <title>487</title>
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
    $input_mode = "489";
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