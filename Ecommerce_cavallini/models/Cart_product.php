<?php

namespace models;
use DbManager;
use PDO;
require_once "../DbManager.php";
class Cart_product
{
    private $quantita;
    private $cart_id;
    private $product_id;

    public static function Create($params)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("insert into e5_ecommerce.cart_products(quantita,cart_id,product_id) values (:quantita,:cart_id,:product_id)");
        $stm->bindParam(":quantita",$params['quantita']);
        $stm->bindParam(":cart_id",$params['cart_id']);
        $stm->bindParam(":product_id",$params['product_id']);
        $stm->execute();
        $cart_product=Cart_product::Find($params);
        return $cart_product;
    }
    public static function Find($params)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.cart_products where cart_id=:cart_id and product_id=:product_id");
        $stm->bindParam(":cart_id",$params['cart_id']);
        $stm->bindParam(":product_id",$params['product_id']);
        $stm->execute();
        $cart_product=$stm->fetchObject(__CLASS__);
        return $cart_product;
    }
    public static function FindbyUser($params)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("select * from e5_ecommerce.cart_products where cart_id=:cart_id");
        $stm->bindParam(":cart_id",$params['cart_id']);
        $stm->execute();
        $cart_product = $stm->fetchAll(PDO::FETCH_ASSOC);
        var_dump($cart_product);
        return $cart_product;
    }
    public function Update($params)
    {
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm=$pdo->prepare("update e5_ecommerce.cart_products set quantita=:quantita where cart_id=:cart_id and product_id=:product_id");
        $stm->bindParam(":quantita",$params['quantita']);//collega i parametri che gli passiamo alla query
        $stm->bindParam(":cart_id",$this->cart_id);
        $stm->bindParam(":product_id",$this->product_id);
        $stm->execute();
        $cart_product=Cart_product::Find($params);
        return $cart_product;
    }
    public static function Test($params)
    {
        //per recuperare i dettagli dei prodotti associati a un carrello specificato
        $db=new DbManager('localhost',3306,'mari','ecom123!');
        $pdo=$db->connect('e5_ecommerce');
        $stm = $pdo->prepare("select e5_ecommerce.products.nome, e5_ecommerce.products.marca, e5_ecommerce.products.prezzo, tb1.quantita 
                                    from (SELECT * 
                                    FROM e5_ecommerce.cart_products 
                                    INNER JOIN e5_ecommerce.carts ON e5_ecommerce.cart_products.cart_id = e5_ecommerce.carts.id 
                                    WHERE e5_ecommerce.cart_products.cart_id = :id)tb1
                                    inner join e5_ecommerce.products on tb1.product_id = e5_ecommerce.products.id
                                    ");
        $stm->bindParam(":id", $params["cart_id"]);
        $stm->execute();

        $cart_product = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $cart_product;
    }
    public function getQuantita()
    {
        return $this->quantita;
    }

    public function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }

    public function getCartId()
    {
        return $this->cart_id;
    }

    public function setCartId($cart_id)
    {
        $this->cart_id = $cart_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

}