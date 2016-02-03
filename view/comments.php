<?php
require_once __DIR__ . '/../class/comment.php';
if ($get_id) {
    $comment = new Comment();
    $res = $comment->getAllList($get_id);
}?>

<table Align="center"><?php
    foreach ($res as $row) {?>
    <tr>
        <?php if (isset($_SESSION["user_name"])) {?>
            <td><a href="./comment_edit?id=<?php print $row[id]?>"><?php print $row[user_id]?></a></td>
        <?php }
        else {?>
            <td><?php print $row[user_id]?></td>
        <?php }?>
        <td><?php print $row[created_at]?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print $row[text]?></td>
    </tr>
<?php }?>
</table>
