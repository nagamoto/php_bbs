<?php
require_once __DIR__ . '/baseModel.php';

class Comment extends BaseModel{
    private $user_id;
    private $thread_id;
    private $text;

    public function __construct($user_id, $thread_id, $text){
        $this->name = 'comments';
        $this->user_id = $user_id;
        $this->thread_id = $thread_id;
        $this->text = $text;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getThreadId()
    {
        return $this->thread_id;
    }

    public function setThreadId($thread_id)
    {
        $this->thread_id = $thread_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
    public function getAllList($thread_id){
        $sql = sprintf("SELECT id, user_id, thread_id, created_at, text FROM %s WHERE thread_id = %d ORDER BY created_at", $this->name, $thread_id);
        $rows = $this->getAll($sql);
        return $rows;
    }
    public function getOne($comment_id){
        $sql = sprintf('SELECT * FROM %s WHERE id = :comment_id', $this->name);
        $params = array('comment_id' => $comment_id);
        $row = $this->query($sql, $params);
        return $row;
    }

    public function add($data){
        self::initDb();
        $res = $this->insert($data);
        return $res;
    }

    public function update($data){
        self::initDb();
        $stmt = self::$db->prepare(sprintf("UPDATE %s SET title = :title , text = :text WHERE id = :id", $this->name));
        $stmt->execute([':title'=>$data['title'], ':text'=>$data['text'], ':id'=>$data['thread_id']]);

    }

    public function deleteRow($id){
        self::initDb();
        $where = "id = " . $id;
        $res = $this->delete($where);
        return $res;
    }

}