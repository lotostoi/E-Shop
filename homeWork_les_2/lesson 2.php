<?php
abstract class Goods
{
    private $price;
    private $quantitySales;

    public function getQuantitySales()
    {
        return $this->quantitySales;
    }

    public function setQuantitySales($quantitySales)
    {
        $this->quantitySales = $quantitySales;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    abstract public function getSumOllSales();
}

class DigitalGood extends Goods
{
    public function __construct($price, $quantitySales)
    {
        $this->setPrice($price);
        $this->setQuantitySales($quantitySales);
    }

    public function getSumOllSales()
    {

        return $this->getPrice() / 2 * $this->getQuantitySales();
    }
}

class RealGood extends DigitalGood

{
    public function __construct($price, $quantitySales)
    {
        parent::__construct($price, $quantitySales);
    }

    public function getSumOllSales()
    {

        return $this->getPrice() * $this->getQuantitySales();
    }
}

class GoodByWeight extends RealGood
{
    private $ollWeight;

    public function __construct($price, $ollWeight)
    {
        $this->setPrice($price);
        $this->setOllWeight($ollWeight);
    }

    public function setOllWeight($ollWeight)
    {
        $this->ollWeight = $ollWeight;
    }

    public function getOllWeight()
    {
        return $this->ollWeight;
    }

    public function getSumOllSales()
    {
        return $this->getPrice() * $this->getOllWeight();
    }
}

// обычаня цена
$ordinaryPrice = 400;
// число продаж цифрового товара
$qsDG = 20;  
// число продаж физического товара
$qsRG = 20;
// общий вес проданого товара на вес (кг)
$wDG = 150;


$DG = new DigitalGood($ordinaryPrice, $qsDG);
echo $DG->getSumOllSales() . " руб - Общая cтоимость цифрового товара, в количеством - " .  $DG->getQuantitySales() . " шт., при цене за шутуку - " . $DG->getPrice() . " руб. </br>";

$RG = new RealGood($ordinaryPrice, $qsRG);
echo $RG->getSumOllSales() . " руб - Общая cтоимость физического товара, в количеством - " .  $RG->getQuantitySales() . "шт., при цене за шутуку - " . $RG->getPrice() . " руб. </br>";

$WG = new GoodByWeight($ordinaryPrice, $wDG);
echo $WG->getSumOllSales() . " руб - Общая cтоимость товара на вес, при общем весе - " .  $WG->getOllWeight() . " кг, при цене за кг - " . $WG->getPrice() . " руб. </br>";