<?php
/**
 * Created by PhpStorm.
 * User: rupak
 * Date: 25.09.2018
 * Time: 19:02
 */

class Car
{
    public $color = 'white';
    public $speed;
    public $fuel;
    public $brand;
    
    public function __construct()
    {
        echo __CLASS__ . __METHOD__;
    }

    public function TripTime($distance)
    {
        $time = $distance / $this->speed;
        return $time;
    }
}

$car1 = new Car;
$car1->brand = 'Audi';
$car1->speed = 110;
$car1->fuel = 12;

$car2 = new Car;
$car2->brand = 'Fiat';
$car2->speed = 130;
$car2->fuel = 14;
$car2->color = 'Black';

echo $car1->TripTime(1000) . '<br>';
echo $car2->TripTime(1000);
