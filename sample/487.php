<?php
  // セッション開始
  session_name("DIARY");
  session_start();

  // 設定の読み込み
  require("config.php");

  // 変数を展開
  $input_mode = ($_GET["mode"]) ? $_GET["mode"] : $_POST["mode"];
  $input_action = ($_GET["action"]) ? $_GET["action"] : $_POST["action"];
  $input_date = ($_GET["date"]) ? $_GET["date"] : $_POST["date"];

  // ヘッダの出力
  header("Content-Type: text/html; charset=EUC-JP");

  // データベースに接続
  $db = @mysql_connect(DIARY_DB_HOST, DIARY_DB_USER, DIARY_DB_PASS)
           or die("システムエラーです。管理者に連絡してください。");
  @mysql_select_db(DIARY_DB_NAME, $db)
           or die("システムエラーです。管理者に連絡してください。");

  // ログアウト
  if($input_action == "logout")
  {
    // 認証テーブルに登録したセッションを削除
    $query = "DELETE FROM " . DIARY_TABLE_AUTH
           . " WHERE uid = '" . $_SESSION["uid"] . "'"
           . " AND sid = '" . md5(session_id()) . "'";
    @mysql_query($query, $db);

    // セッションを破棄
    $_SESSION = array();
    session_destroy();
    header("Location: 482.php?date={$input_date}");
    exit();
  }

  // ユーザー認証
  include("488.php");

  // ページの表示
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

  // 必要なファイルをインクルード
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

  // 切断
  mysql_close($db);
?>