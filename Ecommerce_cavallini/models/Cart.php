<?php

namespace models;
use DbManager;
require_once "../DbManager.php";
class Cart
{
    private $id;
    private $user_id;

    public static function Find($id)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.carts where id=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        $cart=$stm->fetchObject(__CLASS__);
        return $cart;
    }
    public static function Create($user_id)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("insert into e5_ecommerce.carts(user_id)values (:user_id)");
        $stm->bindParam(":user_id",$user_id);
        $stm->execute();
        $cart=Cart::FindbyUser($user_id);
        return $cart;
    }

    public static function FindbyUser($id)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.carts where user_id=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        $cart=$stm->fetchObject(__CLASS__);
        return $cart;
    }
    public function SetId($id)
    {
        $this->id=$id;
    }
    public function GetId()
    {
        return $this->id;
    }
    public function SetUser_id($user_id)
    {
        $this->user_id=$user_id;
    }
    public function GetUser_id()
    {
        return $this->user_id;
    }
}