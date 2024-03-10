<?php

namespace models;

use DbManager;
require_once "../DbManager.php";

class Session
{
    private $id;
    private $ip;
    private $data_login;
    private $user_id;
    public static function Create($params)
    {
        $date = date('Y-m-d H:i:s');
        $db=new DbManager('localhost', 3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("insert into e5_ecommerce.sessions(ip,data_login,user_id)values (:ip,:data_login,:user_id)");
        $stm->bindParam(":ip",$params["ip"]);
        $stm->bindParam(':data_login',$date);
        $stm->bindParam(":user_id",$params["user_id"]);
        $stm->execute();
    }
    public static function Find($user_id)
    {
        $db = new DbManager('localhost', 3306, 'mari', 'ecom123!');
        $pdo = $db->connect('e5_ecommerce');
        $stm=$pdo->prepare("SELECT * FROM sessions WHERE user_id = :user_id") ;
        $stm->bindParam(':user_id', $user_id);
        $stm->execute();
        $record = $stm->fetchObject(__CLASS__);
        return $record;
    }
    public function Delete()
    {
        $db = new DbManager('localhost', 3306, 'mari', 'ecom123!');
        $pdo = $db->connect('e5_ecommerce');
        $id = $this->getId();
        $stm=$pdo->prepare("DELETE FROM sessions WHERE id = :id") ;
        $stm->bindParam(':id', $id);
        $stm->execute();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setIp($ip)
    {
        $this->ip = $ip;
    }
    public function getIp()
    {
        return $this->ip;
    }
    public function setDataLogin($data_login)
    {
        $this->data_login = $data_login;
    }
    public function getDataLogin()
    {
        return $this->data_login;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

}