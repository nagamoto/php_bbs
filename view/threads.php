<?php
include __DIR__ . "/parts/header.php";
require_once __DIR__ . '/../class/thread.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_id = 1;
    $title = filter_input( INPUT_POST, "thread_title" );
    $text = filter_input( INPUT_POST, "thread_text" );
    $stmt = $db->prepare("INSERT into threads (title, text, user_id) values (?, ?, ?)");
    $stmt->execute([$title, $text, $user_id]);
}
else {
    $get_id = filter_input( INPUT_GET, "id" );
    $post_id = filter_input( INPUT_POST, "id" );
    $delete_id = filter_input( INPUT_DELETE, "id" );
}

if ($delete_id) {
exit;
}
if ($get_id) {
    $thread = new Thread();
    $res = $thread->getOne($get_id);
    ?>
<table Align="center">
    <tr>
        <td>title:</td>
        <td><?php print $res[0]['title']?></td>
        </tr>
    <tr>
        <td>created_at:</td>
        <td><?php print $res[0]['created_at']?></td>
        </tr>
</table>
    <Div Align="center">
<?php print $res[0]['text']?>
</Div>
    <?php
}
else{



}

include __DIR__ . "/parts/footer.php";
