<?php
session_start();
include __DIR__ . "/view/parts/header.php";
include __DIR__ . "/view/parts/sign_in_form.php";
require_once __DIR__ . '/class/baseModel.php';
BaseModel::initDb();

require_once __DIR__ . '/class/thread.php';

try {
?>
<table Align="center">
    <tr>
        <td>title:</td>
        <td>created_at:</td>
        <td>text:</td>
        </tr>
<?php
    $thread = new Thread();
    foreach ($thread->getAllList() as $row) {?>
    <tr>
        <td><a href="/bbs/view/threads?id=<?php print $row[id]?>"><?php print $row[title]?></a></td>
        <td><?php print $row[created_at]?></td>
        <td><?php print $row[text]?></td>
    </tr>
    <?php
    }?>
</table>
<?php

} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    echo $e->getMessage();
    print <<<_EOT_
ERROR
_EOT_;
    exit;
}
if (isset($_SESSION["user_id"])) {
    include __DIR__ . "/view/parts/thread_form.php";
}
include __DIR__ . "/view/parts/footer.php";

?>