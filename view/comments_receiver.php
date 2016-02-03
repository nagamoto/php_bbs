<?php
session_start();

require_once __DIR__ . '/../class/comment.php';
$comment = new Comment();
$comment_id = filter_input( INPUT_GET, "id" );
$user_id = filter_input( INPUT_POST, "user_id" );
$thread_id = filter_input(INPUT_POST, "thread_id");
$text = filter_input(INPUT_POST, "text");

$action = $_SERVER['REQUEST_METHOD'];
if($get_action = filter_input( INPUT_POST, "action" )){
    if ($user_id != $_SESSION['user_id'] ){
        header("Location: /bbs/");
        exit;
    }
    $action = filter_input( INPUT_POST, "action" );
}

switch ($action){
    case 'UPDATE'://update comment
        $params = array('id'=> $comment_id,'text' => $text);
        $comment->update($params);
        header("Location: /bbs/view/threads?id=" . $thread_id);
        exit;
    case 'POST'://new comment
        $user_id = $_SESSION["user_id"];
        $params = array('user_id'=> $user_id,'thread_id'=> $thread_id,'text' => $text);
        $comment->add($params);
        header("Location: /bbs/view/threads?id=" . $thread_id);
        exit;
    case 'DELETE':
        print $comment_id;
        if ($comment_id) {//DELETE
            $comment->deleteRow($comment_id);
        }
        header("Location: /bbs/view/threads?id=" . $thread_id);
        exit;
}
