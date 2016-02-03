<?php
include __DIR__ . "/parts/header.php";
include __DIR__ . "/parts/sign_in_form.php";
require_once __DIR__ . '/../class/thread.php';
$get_id = filter_input( INPUT_GET, "id" );
$action = $_SERVER['REQUEST_METHOD'];
if($get_action = filter_input( INPUT_GET, "action" )){
    $action = 'DELETE';
}
switch ($action){
    case 'POST':
        $title = filter_input(INPUT_POST, "title");
        $text = filter_input(INPUT_POST, "text");
        $thread = new Thread();
        if ($get_id) {//既存をupdate
            $params = array('thread_id'=> $get_id,'title' => $title,'text' => $text);
            $thread->update($params);
        }
        else{//新規をPOST
            $user_id = 2;//本来はログイン情報から持ってくる
            $params = array('user_id'=> $user_id,'title' => $title,'text' => $text);
            $get_id = $thread->add($params);
        }
        break;
    case 'DELETE':
        if ($get_id) {//DELETE
            $thread = new Thread();
            $thread->deleteRow($get_id);
            header('Location: /bbs/');
            exit;
        }
        else{
            print "delete miss";
        }
        break;
}
if ($get_id) {
    $thread = new Thread();
    $res = $thread->getOne($get_id);
    ?>
    <Div Align="right">
        <a href="<?php print "./threads?id=" . $res[0]['id']?>&action=delete">delete</a>
    </Div>
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
    include __DIR__ . "/comments.php";
    include __DIR__ . "/parts/comment_form.php";

}

include __DIR__ . "/parts/footer.php";
