<?php
require_once "../Ecommerce_cavallini/DbManager.php";
$db=new DbManager('localhost',3306, 'mari','ecom123!');
$pdo=$db->connect('e5_ecommerce');
