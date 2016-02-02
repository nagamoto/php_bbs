<?php
  // アクセス制限
  if(ereg("492.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 487.php");
    exit();
  }

  $link_date = urlencode($input_date);

  try
  {
    // アクセス先の簡易チェック
    if(!ereg($_SERVER["PHP_SELF"], $_SERVER["HTTP_REFERER"]))
    {
      throw(new Exception("不正なアクセスです"));
    }

    // リクエストメソッドチェック
    if(strtoupper($_SERVER["REQUEST_METHOD"]) != "POST")
    {
      throw(new Exception("不正なリクエストです"));
    }

    // データの削除
    $query = "DELETE FROM " . DIARY_TABLE_LOG
           . " WHERE modify = '{$input_date}'";
    $result = @mysql_query($query, $db);

    if(!$result)
    {
      throw(new Exception("メッセージを削除できません"));
    }

    // カレンダーの表示
    include("484.php");

    // メッセージの表示
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
<font color="#ff3366">データを削除しました</font><br>
<br>
<a href="487.php?date={$link_date}">[ 戻る ]</a>
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
    $msg = $e->getMessage();

    // メッセージの表示
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
<font color="#ff3366">エラー：{$msg}</font><br>
<br>
<a href="487.php?date={$link_date}">[ 戻る ]</a>
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