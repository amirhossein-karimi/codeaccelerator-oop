<?php
require_once 'IProduct.php';
require_once 'IBasket.php';
require_once 'Product.php';
require_once 'Basket.php';
require_once 'Discount.php';

$phone = new Product();
$phone->setTitle('Samsung A51');
$phone->setPrice(15000000);

$watch = new Product();
$watch->setTitle('Smart Watch Samsung');
$watch->setPrice(12500000);

$basket = new Basket('amirkarimi@gmail.com');
$basket->addProduct($phone, 3);
$basket->addProduct($watch, 1);

$basket->removeProduct($phone->getID(), 1);

$discount = new Discount($basket, Discount::PERCENT);

echo "------------------------------" . PHP_EOL;
echo "Total basket price : {$basket->getTotalPrice()}" . PHP_EOL;
echo "------------------------------" . PHP_EOL;
echo "Total price after discount calculate : {$discount->calculate(33)}" . PHP_EOL;
echo "------------------------------";
