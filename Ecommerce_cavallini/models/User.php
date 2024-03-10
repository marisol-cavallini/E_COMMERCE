<?php

namespace models;
use DbManager;
require_once "../DbManager.php";
class User
{
    private $id;
    private $email;
    private $password;
    private $role_id;

    public static function Create($params)
    {
        $db=new DbManager('localhost', 3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("insert into e5_ecommerce.users(email, password, role_id) values (:email, :password, 1)");
        $stm->bindParam(":email",$params['email']);
        $stm->bindParam(":password",$params['password']);
        $stm->execute();
        $user=User::Find($params);
        return $user;
    }
    public static function Find($params)
    {
        $db=new DbManager('localhost', 3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare('select * from e5_ecommerce.users where email=:email and password=:password');
        $stm->bindParam(":email",$params['email']);
        $stm->bindParam(':password',$params['password']);
        $stm->execute();
        $user=$stm->fetchObject(__CLASS__);
        return $user;
    }

    public static function Find_User($email)
    {
        $db=new DbManager('localhost', 3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare('select * from e5_ecommerce.users where email=:email');
        $stm->bindParam(":email",$email);
        $stm->execute();
        $user=$stm->fetchObject(__CLASS__);
        return $user;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function GetId()
    {
        return $this->id;
    }
    public function SetEmail($email)
    {
        $this->email=$email;
    }
    public function GetEmail()
    {
        return $this->email;
    }
    public function SetPassword($passw)
    {
        $this->password=$passw;
    }
    public function GetPassword()
    {
        return $this->password;
    }
    public function SetRole_id($role_id)
    {
        $this->role_id=$role_id;
    }
    public function GetRole_id()
    {
        return $this->role_id;
    }
}