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
        $sql = sprintf("SELECT id, title, created_at, text FROM %s ORDER BY created_at", $this->name);
        $rows = $this->getAll($sql);
        return $rows;
    }
    public function getOne($thread_id){
        $sql = sprintf('SELECT * FROM %s WHERE id = :thread_id', $this->name);
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