<?php

namespace models;
use DbManager;
USE PDO;
require_once "../DbManager.php";
class Product
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;

    public static function Create($params)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare('insert into e5_ecommerce.products(nome,prezzo,marca)values(:nome,:prezzo,:marca)');
        $stm->bindParam(":nome",$params['nome']);
        $stm->bindParam(":prezzo",$params['prezzo']);
        $stm->bindParam(":marca",$params['marca']);
        $stm->execute();
        $product=Product::Find($params);
        return $product;

    }

    public static function Find($id)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.products where id=:id");
        $stm->bindParam(":id",$params['id']);
        $stm->execute();
        $product=$stm->fetchObject(__CLASS__);
        return $product;
    }
    public static function FindAll()
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.products");
        $stm->execute();
        $product=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    public function Update()
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare('update e5_ecommerce.products set nome=:nome, prezzo=:prezzo, marca=:marca where id=:id ');
        $stm->bindParam(":nome",$this->nome);
        $stm->bindParam(":prezzo",$this->prezzo);
        $stm->bindParam(":marca",$this->marca);
        $stm->bindParam(":id",$this->id);
        $stm->execute();
        $params = array("id" => $this->id, "nome" => $this->nome, "prezzo" => $this->prezzo, "marca" => $this->marca);
        $product = product::Find($params);
        return $product;
    }
    public function Delete()
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("delete from e5_ecommerce.products where id=:id");
        $stm->bindParam(":id",$this->id);
        $stm->execute();
        return null;
    }

    public static function fetchAll() {

        $db = new DbManager('localhost', 3306, 'mari', 'ecom123!');
        $ecommerce = $db->connect('e5_ecommerce');
        $sql = "select * from e5_ecommerce.products";
        return $ecommerce->query($sql)->fetchAll(PDO::FETCH_CLASS);
    }
    public function SetId($id)
    {
        $this->id=$id;
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

    public function SetPrezzo($price)
    {
        $this->prezzo=$price;
    }
    public function GetPrezzo()
    {
        return $this->prezzo;
    }
    public function SetMarca($marca)
    {
        $this->marca=$marca;
    }
    public function GetMarca()
    {
        return $this->marca;
    }
}