<?php
require_once __DIR__ . '/baseModel.php';

class User extends BaseModel{
    private $user_name;
    private $pass;

    public function __construct($name, $pass){
        $this->name = 'users';
        $this->user_name = $name;
        $this->pass = $pass;
    }

    public function getName()
    {
        return $this->user_name;
    }

    public function setName($name)
    {
        $this->user_name = $name;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getUsersIDandPass($user_name){
        $sql = sprintf('SELECT id, pass FROM %s WHERE name = :user_name', $this->name);
        $params = array('user_name' => $user_name);
        $row = $this->query($sql, $params);
        $res = array('id'=> $row[0]['id'], 'pass'=> $row[0]['pass']);
        return $res;
    }

    public function add($data){
        self::initDb();
        $res = $this->insert($data);
        return $res;
    }

    public function deleteRow($id){
        self::initDb();
        $where = "id = " . $id;
        $res = $this->delete($where);
        return $res;
    }

    private function passMD5($pass){
        $salt = "qwertyujikolp;@:";
        //パスワードはハッシュ化する
        $password = md5($pass . $salt);
        return $password;
    }

    public function isAuthenticate($user_name, $pass){
        $password = $this->passMD5($pass);
        $params = array('name'=> $user_name, 'pass' => $password);
        $res = $this->add($params);
        return $res;
    }

    public function signIn($user_name, $pass){
        $password = $this->passMD5($pass);
        $idAndPass = $this->getUsersIDandPass($user_name);
        $password_inDB = $idAndPass['pass'];
        If ($password == $password_inDB) return $idAndPass['id'];
        return "false";
    }

}