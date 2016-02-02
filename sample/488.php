<?php
  // ������������
  if(ereg("488.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 487.php");
    exit();
  }

  // �ѥ���ɥ����å�
  if($_POST["user"] && $_POST["pass"])
  {
    // �������
    $input_user = md5($_POST["user"]);
    $input_pass = md5($_POST["pass"]);

    // ��������桼��������Ͽ����Ƥ��뤫Ĵ�٤�
    $query = "SELECT * FROM " . DIARY_TABLE_USER
           . " WHERE name = '{$input_user}'"
           . " AND pass = '{$input_pass}'";
    $result = @mysql_query($query, $db);
    $num_rows = @mysql_num_rows($result);

    if($num_rows == 1)
    {
      // ��ˡ�����ID��������ƥ��å�����ѿ��˳�Ǽ
      list($mtime, $time) = explode(" ", microtime());
      $seed = (double) $mtime + (double) $time;
      mt_srand($seed);
      $_SESSION["uid"] = md5(uniqid(mt_rand(), 1));

      // ǧ�ڤ�ͭ�����¤�����
      $timestamp = time() + DIARY_AUTH_LIFE;
      $lifetime = date("Y-m-d H:i:s", $timestamp);

      // ͭ�����¤��ڤ줿���å�����ǧ�ڥơ��֥뤫����
      $query = "DELETE FROM " . DIARY_TABLE_AUTH
             . " WHERE life < now()";
      @mysql_query($query, $db);

      // ���������å�����ǧ�ڥơ��֥����Ͽ
      $query = "INSERT INTO " . DIARY_TABLE_AUTH . " VALUES("
             . "'" . $_SESSION["uid"] . "',"
             . "'" . md5(session_id()) . "',"
             . "'" . $lifetime . "')";
      $is_success = @mysql_query($query, $db);

      // ǧ�������򼨤���������
      if($is_success)
      {
        define("USER_IS_AUTH", 1);
      }
    }
  }
  else
  {
    // ������ѤߤΤȤ�
    $query = "DELETE FROM " . DIARY_TABLE_AUTH
           . " WHERE life < now()";
    @mysql_query($query, $db);

    // ǧ�ڥơ��֥��Ĵ�٤�
    $query = "SELECT * FROM " . DIARY_TABLE_AUTH
           . " WHERE uid = '" . $_SESSION["uid"] . "' "
           . " AND sid = '" . md5(session_id()) . "'";
    $result = @mysql_query($query, $db);
    $is_success = @mysql_num_rows($result);

    if($is_success == 1)
    {
      define("USER_IS_AUTH", 1);
    }
  }

  // ������ե������ɽ��
  if(!defined("USER_IS_AUTH") || USER_IS_AUTH != 1)
  {
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
<parts method="POST" action="487.php">
<table border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>�桼����̾</td>
    <td><input type="text" name="user" maxlength="8"></td>
  </tr>
  <tr>
    <td>�ѥ����</td>
    <td><input type="password" name="pass" maxlength="8"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">
      <input type="submit" value="������">
    </td>
  </tr>
</table>
</parts>
</body>
</html>
_EOT_;
    exit();
  }
?>