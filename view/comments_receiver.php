<?php

require_once __DIR__ . '/../class/comment.php';
$action = $_SERVER['REQUEST_METHOD'];
if($get_action = filter_input( INPUT_GET, "action" )){
    $action = filter_input( INPUT_GET, "action" );
}
$comment = new Comment();
$comment_id = filter_input( INPUT_GET, "id" );
$thread_id = filter_input(INPUT_POST, "thread_id");
$text = filter_input(INPUT_POST, "text");

switch ($action){
    case 'UPDATE'://update comment
        $params = array('thread_id'=> $thread_id,'text' => $text);
        $comment->update($params);
        header("Location: /bbs/view/threads?id=" . $thread_id);
        break;
    case 'POST'://new comment
        $user_id = 1;//本来はログイン情報から持ってくる
        $params = array('user_id'=> $user_id,'thread_id'=> $thread_id,'text' => $text);
        $comment->add($params);
        header("Location: /bbs/view/threads?id=" . $thread_id);
        break;
    case 'DELETE':
        if ($comment_id) {//DELETE
            $comment->deleteRow($comment_id);
            header("Location: /bbs/");
            exit;
        }
        else{
            header("Location: /bbs/");
        }
        break;
}
print "debug:none";
