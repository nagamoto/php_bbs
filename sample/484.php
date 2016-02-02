<?php
  // アクセス制限
  if(ereg("484.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 482.php");
    exit();
  }

  // 日付の計算
  $current = explode("-", $input_date);
  $year = (int) $current[0];
  $mon = (int) $current[1];
  $mday = (int) $current[2];
  $timestamp = mktime(0, 0, 0, $mon, 1, $year);
  $first_wday = date("w", $timestamp);
  $day_of_month = date("t", $timestamp);
  $cols = 7;
  $rows = ceil(($first_wday + $day_of_month) / $cols);

  // 前の月
  $back_mon = ($mon == 1) ? 12 : $mon - 1;
  $back_year = ($back_mon == 12) ? $year - 1 : $year;
  $back_date = urlencode(sprintf("%04d-%02d-%02d", $back_year, $back_mon, 1));

  // 次の月
  $next_mon = ($mon == 12) ? 1 : $mon + 1;
  $next_year = ($next_mon == 1) ? $year + 1 : $year;
  $next_date = urlencode(sprintf("%04d-%02d-%02d", $next_year, $next_mon, 1));

  // カレンダーの表示
  print <<<_EOT_
<table border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="7" align="center">\n
_EOT_;

  if(defined("USER_IS_AUTH") && USER_IS_AUTH == 1)
  {
    // 管理モード時
    print <<<_EOT_
<a href="487.php?date={$back_date}">&lt;&lt;</a>
&nbsp;{$year}年{$mon}月&nbsp;
<a href="487.php?date={$next_date}">&gt;&gt;</a>\n
_EOT_;
  }
  else
  {
    // 通常モード時
    print <<<_EOT_
<a href="482.php?date={$back_date}">&lt;&lt;</a>
&nbsp;{$year}年{$mon}月&nbsp;
<a href="482.php?date={$next_date}">&gt;&gt;</a>\n
_EOT_;
  }

  print <<<_EOT_
    </td>
  </tr>
  <tr>
    <td align="center"><font color="#ff6699">日</font></td>
    <td align="center">月</td>
    <td align="center">火</td>
    <td align="center">水</td>
    <td align="center">木</td>
    <td align="center">金</td>
    <td align="center"><font color="#4169e1">土</font></td>
  </tr>\n
_EOT_;

  $count = 0;
  for ($i = 0; $i < $rows; $i++)
  {
    print "  <tr>\n";
    for ($j = 0; $j < $cols; $j++)
    {
      if($count < $first_wday || $count >= $day_of_month + $first_wday)
      {
        print "    <td>&nbsp;</td>\n";
      }
      else
      {
        // 表示する日付
        $today = $count - $first_wday + 1;

        // 記事確認用日付
        $date_string = sprintf("%4d-%02d-%02d", $year, $mon, $today);

        // 記事があるか確認
        $query = "SELECT id FROM " . DIARY_TABLE_LOG
               . " WHERE modify = '{$date_string}'";
        $result = @mysql_query($query, $db);
        $num_rows = @mysql_num_rows($result);

        // リンク用日付
        $date_string = urlencode($date_string);

        if($num_rows == 1)
        {
          if(defined("USER_IS_AUTH") && USER_IS_AUTH == 1)
          {
            // 管理モード時
            print <<<_EOT_
    <td align="center" bgcolor="#ffcc00">
      <a href="487.php?date={$date_string}">{$today}</a>
    </td>\n
_EOT_;
          }
          else
          {
            // 通常モード時
            print <<<_EOT_
    <td align="center" bgcolor="#ffcc00">
      <a href="482.php?date={$date_string}">{$today}</a>
    </td>\n
_EOT_;
          }
        }
        else
        {
          if(defined("USER_IS_AUTH") && USER_IS_AUTH == 1)
          {
            // 管理モード時
            print <<<_EOT_
    <td align="center">
      <a href="487.php?date={$date_string}">{$today}</a>
    </td>\n
_EOT_;
          }
          else
          {
            // 通常モード時
            print '    <td align="center">' . $today . "</td>\n";
          }
        }
      }
      $count++;
    }
    print "  </tr>\n";
  }

  print <<<_EOT_
</table>
<br><br>\n
_EOT_;
?>