<?php
session_start();
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
if ($user_id != $_SESSION['user_id'] ){
    header("Location: /bbs/");
    exit;
}

?>
<Div Align="right">
    <form action="<?php print "./comments_receiver?id=" . $id ?>" method="POST">
        <input type="hidden" name="action" value='DELETE'>
        <input type="hidden" name="thread_id" value="<?php echo $thread_id?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        <input type="submit" value="delete">
    </form>
</Div>
<Div Align="center">
    <h2>comment_edit</h2>
    <form action="<?php print "./comments_receiver?id=" . $id ?>" method="POST">
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
    <input type="hidden" name="action" value='UPDATE'>
    <input type="hidden" name="thread_id" value="<?php echo $thread_id?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
    <input type="submit" value="update">
    <input type="submit" value="cancel">
</form>
</Div>

