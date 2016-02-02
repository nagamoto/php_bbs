<?php
require_once __DIR__ . '/../config.php';

class BaseModel {
    protected static $db;
    protected $name;

    public function __construct(){
    }

    public static function initDb(){
        self::$db = new PDO(PDO_DSN, DB_USER, DB_PASS);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // クエリ結果を取得
    public function getAll($sql){
        $rows = self::$db->query($sql);
        return $rows;
    }

    // クエリ結果を取得
    public function query($sql, array $params = array()){
        self::initDb();
        $stmt = self::$db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    // INSERTを実行
    public function insert($data){
        $fields = array();
        $values = array();
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->name,
            implode(',', $fields),
            implode(',', $values)
        );
        $stmt = self::$db->prepare($sql);
        foreach ($data as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        $res  = $stmt->execute();

        return $res;
    }

    // DELETEを実行
    public function delete($where, $params = null){
        $sql = sprintf("DELETE FROM %s", $this->name);
        if ($where != "") {
            $sql .= " WHERE " . $where;
        }
        $stmt = self::$db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $res = $stmt->execute();

        return $res;
    }
}