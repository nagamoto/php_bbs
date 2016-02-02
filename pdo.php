<?php
  require("config.php");


try {
    $db = new PDO(PDO_DSN, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //exec 結果返さない
    // query 結果を返す
    // prepare 結果を返す。安全対策が必要な場合に用いる
    $stmt = $db->prepare("insert into users (name, pass) values (?, ?)");
    $stmt->execute(['nagamoto', 'tatsuya']);
    echo "inserted: " . $db->lastInsertId();

    $stmt = $db->prepare("insert into users (name, pass) values (:name, :pass)");
    $stmt->execute([':name'=>'muratani', ':pass'=>'hiroshi']);
    echo "inserted: " . $db->lastInsertId();

    $name = 'nagamoto';
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $pass = 'tomonori';
    $stmt->bindValue(2, $pass, PDO::PARAM_STR);
    $stmt->execute();
    $pass = 'akiko';
    $stmt->bindValue(2, $pass, PDO::PARAM_STR);
    $stmt->execute();

} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    echo $e->getMessage();
    print <<<_EOT_
ERROR
_EOT_;
    exit;
}


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
<center>
bbs
</center>
</body>
</html>
_EOT_;

?>