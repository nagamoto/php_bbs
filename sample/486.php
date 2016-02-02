<?php
  // アクセス制限
  if(ereg("486.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 482.php");
    exit();
  }

  // 前後の記事を検索
  $query = "SELECT max(modify) FROM " . DIARY_TABLE_LOG
         . " WHERE modify < '{$input_date}'";
  $result = @mysql_query($query, $db);
  $num_rows = @mysql_num_rows($result);

  if($num_rows == 1)
  {
    $date = @mysql_result($result, 0, 0);
    $back = urlencode($date);
  }

  $query = "SELECT min(modify) FROM " . DIARY_TABLE_LOG
         . " WHERE modify > '{$input_date}'";
  $result = @mysql_query($query, $db);
  $num_rows = @mysql_num_rows($result);

  if($num_rows == 1)
  {
    $date = @mysql_result($result, 0, 0);
    $next = urlencode($date);
  }

  // ナビゲーターの表示
  print <<<_EOT_
<table border="0" cellspacing="0" cellpadding="0" width="500">
  <tr>
    <td width="250">\n
_EOT_;

  if($back)
  {
    print "<a href=\"482.php?date={$back}\">&lt;&lt;&nbsp;back</a>\n";
  }
  else
  {
    print "&nbsp;\n";
  }

  print <<<_EOT_
    </td>
    <td width="250" align="right">\n
_EOT_;

  if($next)
  {
    print "<a href=\"482.php?date={$next}\">next&nbsp;&gt;&gt;</a>\n";
  }
  else
  {
    print "&nbsp;\n";
  }

  print <<<_EOT_
    </td>
  </tr>
</table>\n
_EOT_;
?>