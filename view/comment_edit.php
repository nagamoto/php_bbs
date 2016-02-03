<?php
include __DIR__ . "/parts/header.php";
include __DIR__ . "/parts/sign_in_form.php";
require_once __DIR__ . '/../class/comment.php';
$get_id = filter_input( INPUT_GET, "id" );
$comment = new Comment();
$res = $comment->getOne($get_id);
$id = $res[0]['id'];
$user_id = $res[0]['user_id'];
$thread_id = $res[0]['thread_id'];
$text = $res[0]['text'];
$created_at = $res[0]['created_at'];
?>
<Div Align="right">
    <a href="<?php print "./comments_receiver?id=" . $id ?>&action=delete">delete</a>
</Div>
<Div Align="center">
    <h2>comment_edit</h2>
    <form action="./comments_receiver" method="POST">
    <table>
        <tr><td>user_id:</td><td><?php echo $user_id ?></td></tr>
        <tr><td>thread_id:</td><td><?php echo $thread_id ?></td></tr>
        <tr><td>created_at:</td><td><?php echo $created_at ?></td></tr>
        <tr>
            <td>textarea:</td>
            <td><TEXTAREA cols="30" rows="5" name="text" value="<?php
                echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8')?>"><?php
                    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8')?></TEXTAREA></td>
        </tr>
    </table>
    <input type="submit" value="update">
    <input type="submit" value="cancel">
</form>
</Div>

