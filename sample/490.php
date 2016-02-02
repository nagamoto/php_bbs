<?php
  // ������������
  if(ereg("490.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 487.php");
    exit();
  }

  $link_date = urlencode($input_date);

  try
  {
    // ����������δʰץ����å�
    if(!ereg($_SERVER["PHP_SELF"], $_SERVER["HTTP_REFERER"]))
    {
      throw(new Exception("�����ʥ��������Ǥ�"));
    }

    // �ꥯ�����ȥ᥽�åɥ����å�
    if(strtoupper($_SERVER["REQUEST_METHOD"]) != "POST")
    {
      throw(new Exception("�����ʥꥯ�����ȤǤ�"));
    }

    // �ǡ���������
    $data = $_POST;

    foreach ($data as $key => $value)
    {
      $data[$key] = preg_replace("/^(\s|��)+$/", "", $data[$key]);
      $data[$key] = strip_tags($data[$key]);
      $data[$key] = stripslashes($data[$key]);
      $data[$key] = mb_convert_kana($data[$key], "KV");
      $data[$key] = htmlspecialchars($data[$key]);
      $data[$key] = str_replace("\r\n", "<br>", $data[$key]);
      $data[$key] = str_replace("\r", "<br>", $data[$key]);
      $data[$key] = str_replace("\n", "<br>", $data[$key]);
      $data[$key] = mysql_escape_string($data[$key]);
    }

    // �ǡ��������å�
    if(!$data["title"])
    {
      throw(new Exception("�����ȥ뤬���Ϥ���Ƥ��ޤ���"));
    }
    elseif(strlen($data["title"]) > DIARY_TITLE_LIMIT)
    {
      throw(new Exception("�����ȥ뤬ʸ�������¤�Ķ���Ƥ��ޤ�"));
    }

    if(!$data["story"])
    {
      throw(new Exception("��ʸ�����Ϥ���Ƥ��ޤ���"));
    }
    elseif(strlen($data["story"]) > DIARY_STORY_LIMIT)
    {
      throw(new Exception("��ʸ��ʸ�������¤�Ķ���Ƥ��ޤ�"));
    }

    $input_title = $data["title"];
    $input_story = $data["story"];

    // ������Ͽ
    $query = "INSERT INTO " . DIARY_TABLE_LOG
           . "(title,story,modify) VALUES("
           . "'{$input_title}','{$input_story}','{$input_date}')";
    $result = @mysql_query($query, $db);

    if(!$result)
    {
      throw(new Exception("��å���������Ͽ�Ǥ��ޤ���"));
    }

    // �����������ɤ߹���
    include("484.php");

    // �ե������åץ�å�����
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
    <td align="center">
<font color="#ff3366">��������������Ͽ���ޤ���</font><br>
<br>
<a href="487.php?date={$link_date}">[ ��� ]</a>
    </td>
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
  catch (Exception $e)
  {
    // ���顼��å�����
    $msg = $e->getMessage();

    print <<<_EOT_
<br>
<br>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="500">
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="20" border="0"></td>
  </tr>
  <tr>
    <td align="center">
<font color="#ff3366">���顼��{$msg}</font><br>
<br>
<a href="487.php?date={$link_date}">[ ��� ]</a>
    </td>
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
?>