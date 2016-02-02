<?php
include __DIR__ . "/parts/header.php";
include __DIR__ . "/parts/sign_in_form.php";
require_once __DIR__ . '/../class/thread.php';
switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        break;
    case 'DELETE':
        break;
    case 'GET':
        break;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = filter_input(INPUT_POST, "title");
    $text = filter_input(INPUT_POST, "text");
    $thread = new Thread();
    if ($post_id = filter_input( INPUT_GET, "id")) {//既存をupdate
        $params = array('thread_id'=> $post_id,'title' => $title,'text' => $text);
        $thread->update($params);
        $get_id = $post_id;
    }
    else{//新規をPOST
        $user_id = 2;//本来はログイン情報から持ってくる
        $params = array('user_id'=> $user_id,'title' => $title,'text' => $text);
        $get_id = $thread->add($params);
    }
}
else {

    $get_id = filter_input( INPUT_GET, "id" );
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
        <td><a href="<?php print "./thread_edit?id=" . $res[0]['id']?>"><?php print $res[0]['title']?></a></td>
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
