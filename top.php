<?php
/**
 * Created by PhpStorm.
 * User: nagamoto
 * Date: 2016/02/01
 * Time: 7:55
 */
  require("config.php");

//  $input_mode = ($_GET["mode"]) ? $_GET["mode"] : $_POST["mode"];
//  $input_action = ($_GET["action"]) ? $_GET["action"] : $_POST["action"];
//  $input_date = ($_GET["date"]) ? $_GET["date"] : $_POST["date"];

  header("Content-Type: text/html; charset=EUC-JP");


try {
    $db = new PDO(PDO_DSN, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    echo $e->getMessage();
    print <<<_EOT_
ERROR
_EOT_;
    exit;
}

//if(!$input_mode)
//{
//    $input_mode = "";
//}
//include($input_mode . ".php");

//よくわからん
//sql_autoload_register(function($class){
//    require $class . ".class.php";
//});

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
bbs
</center>
</body>
</html>
_EOT_;

?>