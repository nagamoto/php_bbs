<?php
include __DIR__ . "/parts/header.php";
include __DIR__ . "/parts/sign_in_form.php";
require_once __DIR__ . '/../class/thread.php';

$get_id = filter_input( INPUT_GET, "id" );
$thread = new Thread();
$res = $thread->getOne($get_id);
$id = $res[0]['id'];
$thread_title = $res[0]['title'];
$text = $res[0]['text'];
?>
<Div Align="center">
    <h2>thread_form</h2>
    <form action="<?php print "./threads?id=" . $id?>" method="POST">
    <table>
        <tr>
        <td>title:</td>
        <td><input type="text" name="title" placeholder="title" value="<?php echo htmlspecialchars($thread_title, ENT_QUOTES, 'UTF-8')?>"></td>
        </tr>
        <tr>
            <td>textarea:</td>
            <td><TEXTAREA cols="30" rows="5" name="text" value="
        <?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8')?>"><?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8')?></TEXTAREA></td>
            </tr>
    </table>
    <input type="submit" value="update">
    <input type="submit" value="cancel">
</form>
</Div>
<?php
include __DIR__ . "/parts/footer.php";
