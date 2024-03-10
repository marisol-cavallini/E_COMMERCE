<?php

namespace models;
use DbManager;

require_once "../DbManager.php";

class Role
{
    private $id;
    private $nome;
    private $descrizione;

    public static function Find($id)
    {
        $db=new DbManager("localhost",3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm= $pdo->prepare("select * from e5_ecommerce.roles where id=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        $role=$stm->fetchObject(__CLASS__);
        return $role;
    }
    public function GetId()
    {
        return $this->id;
    }

    public function SetNome($name)
    {
        $this->nome=$name;
    }
    public function GetNome()
    {
        return $this->nome;
    }
    public function SetDescrizione($descrition)
    {
        $this->descrizione=$descrition;
    }

    public function GetDescrizione()
    {
        return $this->descrizione;
    }
}