<?php
  if(ereg("config.php", $_SERVER["PHP_SELF"]))
  {
    header("Location: 482.php");
    exit();
  }

//文字設定
  mb_language("Japanese");
  mb_detect_order("auto");
  ini_set("mbstring.http_input", "auto");
  mb_http_output("auto");
  mb_internal_encoding("EUC-JP");
  mb_substitute_character("none");

//DB設定
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "root");
  define("DB_NAME", "bbs_db");
  define("PDO_DSN", 'mysql:dbname=bbs_db;host=127.0.0.1');
  define("TABLE_LOG", "bbs_log");
  define("TABLE_USER", "bbs_user");
  define("TABLE_AUTH", "bbs_auth");

  define("THREAD_TITLE_LIMIT", 255);
  define("THREAD_TEXT_LIMIT", 8192);

  define("DIARY_AUTH_LIFE", 2 * 60 * 60);

?>