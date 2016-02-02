<?php
require_once __DIR__ . '/baseModel.php';

class Thread extends BaseModel{
    private $user_id;
    private $title;
    private $text;
    private $created_at;

    public function __construct($user_id, $title, $text){
        $this->name = 'threads';
        $this->user_id = $user_id;
        $this->title = $title;
        $this->text = $text;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function getAllList(){
        $sql = 'SELECT id, title, created_at, text FROM threads  ORDER BY created_at';
        $rows = $this->getAll($sql);
        return $rows;
    }
    public function getOne($thread_id){
        $sql = sprintf('SELECT * FROM threads WHERE id = :thread_id');
        $params = array('thread_id' => $thread_id);
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
        $stmt = self::$db->prepare("UPDATE threads SET title = :title , text = :text WHERE id = :id");
        $stmt->execute([':title'=>$data['title'], ':text'=>$data['text'], ':id'=>$data['thread_id']]);

    }

    public function deleteRow($id){
        self::initDb();
        print $id;
        $where = "id = " . $id;
        $res = $this->delete($where);
        return $res;
    }

}