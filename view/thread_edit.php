<?php
session_start();
include __DIR__ . "/parts/header.php";
include __DIR__ . "/parts/sign_in_form.php";
require_once __DIR__ . '/../class/thread.php';
if (!isset($_SESSION["user_id"])) {
    header("Location: /bbs/");
    exit;
}
$get_id = filter_input(INPUT_GET, "id");
$thread = new Thread();
$res = $thread->getOne($get_id);
$id = $res[0]['id'];
$thread_user_id = $res[0]['user_id'];
$thread_title = $res[0]['title'];
$text = $res[0]['text'];
if ($thread_user_id != $_SESSION["user_id"]){
    header("Location: /bbs/");
    exit;
}
?>
<Div Align="center">
    <h2>thread_edit</h2>
    <form action="<?php print "./threads?id=" . $id ?>" method="POST">
        <table>
            <tr>
                <td>title:</td>
                <td><input type="text" name="title" placeholder="title"
                           value="<?php echo htmlspecialchars($thread_title, ENT_QUOTES, 'UTF-8') ?>"></td>
            </tr>
            <tr>
                <td>textarea:</td>
                <td><TEXTAREA cols="30" rows="5" name="text" value="<?php
                    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8') ?>"><?php
                        echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8') ?></TEXTAREA></td>
            </tr>
        </table>
        <input type="submit" value="update">
        <input type="submit" value="cancel">
    </form>
</Div>
<?php
include __DIR__ . "/parts/footer.php";
