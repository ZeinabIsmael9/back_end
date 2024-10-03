<?php

/** Liskov Substitution Principle */

class Rectangle
{
    public $width, $height;
    public function setWidth(int $width)
    {
        $this->width = $width;
    }
    public function setHeight(int $height)
    {
        $this->height = $height;
    }
    public function getArea():int
    {
        return $this->width * $this->height;
    }
}
class Suqare extends Rectangle
{
    public function setWidth(int $width)
    {
        $this->width = $width;
        $this->height = $width;
    }
    public function getTotal(){
        return 'Total Square = '. $this->getArea();
    }
}
$rect = new Rectangle;
$rect->setWidth(10);
$rect->setHeight(20);
echo $rect->getArea() . PHP_EOL;
echo "<hr>";

$square = new Suqare;
$square->setWidth(100);
echo $square->getTotal() . PHP_EOL;
echo "<hr>";

