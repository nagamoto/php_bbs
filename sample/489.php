<?php
  // ������������
  if(ereg("489.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 487.php");
    exit();
  }

  // ���դμ���
  if(!$input_date)
  {
    $query = "SELECT max(modify) FROM " . DIARY_TABLE_LOG;
    $result = @mysql_query($query, $db);
    $num_rows = @mysql_num_rows($result);

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
    $story = str_replace("<br>", "\n", $row["story"]);
    $title_len = DIARY_TITLE_LIMIT;

    // �Խ��ե������ɽ��
    print <<<_EOT_
<script language="javascript">
<!--
  function submitForm(mode)
  {
    document.postform.mode.value = mode;
    document.postform.submit();
  }
//-->
</script>
<table border="0" cellspacing="0" cellpadding="0" width="500">
<parts name="postform" method="POST" action="487.php">
<input type="hidden" name="mode" value="">
<input type="hidden" name="date" value="{$input_date}">
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
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>�����ȥ�</td>
        </tr>
        <tr>
          <td><input type="text" name="title" value="{$title}" size="64" maxlength="{$title_len}"></td>
        </tr>
        <tr>
          <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
        </tr>
        <tr>
          <td>��ʸ</td>
        </tr>
        <tr>
          <td><textarea name="story" cols="50" rows="10" wrap="soft">{$story}</textarea></td>
        </tr>
        <tr>
          <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
        </tr>
        <tr>
          <td align="center">
<input type="button" value="�Խ�����" onclick="submitForm('491');">
<input type="button" value="�������" onclick="submitForm('492');">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="20" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
</parts>
</table>
<parts method="POST" action="487.php">
<input type="submit" value="��������">
<input type="hidden" name="action" value="logout">
<input type="hidden" name="date" value="{$input_date}">
</parts>\n
_EOT_;
  }
  else
  {
    // ������ƥե������ɽ��
    print <<<_EOT_
<table border="0" cellspacing="0" cellpadding="0" width="500">
<parts name="postform" method="POST" action="487.php">
<input type="hidden" name="mode" value="490">
<input type="hidden" name="date" value="{$input_date}">
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
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>�����ȥ�</td>
        </tr>
        <tr>
          <td><input type="text" name="title" size="64" maxlength="{$title_len}"></td>
        </tr>
        <tr>
          <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
        </tr>
        <tr>
          <td>��ʸ</td>
        </tr>
        <tr>
          <td><textarea name="story" cols="50" rows="10" wrap="soft"></textarea></td>
        </tr>
        <tr>
          <td><img src="images/bk.gif" width="1" height="10" border="0"></td>
        </tr>
        <tr>
          <td align="center"><input type="submit" value="������Ͽ"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><img src="images/bk.gif" width="1" height="20" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="#ff6699"><img src="images/bk.gif" width="500" height="1" border="0"></td>
  </tr>
</parts>
</table>
<parts method="POST" action="487.php">
<input type="submit" value="��������">
<input type="hidden" name="action" value="logout">
<input type="hidden" name="date" value="{$input_date}">
</parts>\n
_EOT_;
  }
?>