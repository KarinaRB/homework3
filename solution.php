<?php

require('Car.php');
require ('Driver.php');

//Получение данных из файла json
$ourData = file_get_contents("data.json");
$object = json_decode($ourData);

//Создание массивов машин и водителей
$countOfCars = count($object->cars);
$countOfDrivers = count($object->drivers);
for($var=0; $var<$countOfCars; $var++){
    $cars[$var] = CarFactory::createCar($object->cars[$var]->brand, $var, $object->cars[$var]->km);
}
for($var=0; $var<$countOfDrivers; $var++){
    $drivers[$var]= DriverFactory::createDriver($object->drivers[$var]->type, $var);
}

//Распределение водителей по машинам
for($var=0; $var<$countOfDrivers && $var<$countOfCars; $var++){
    $facade[$var]=new Facade($cars[$var], $drivers[$var]);
}

//Получение дней работы
unset($argv[0]);
$line = implode(" ", $argv);
$data = explode(" ", $line);
$days = $data[0];
//Моделирование работы таксопарка
for($var=0; $var<$days; $var++){
    foreach ($facade as $pair){
        $pair->workOneDay();
    }
}

//Формирование отчёта
$distance=0;
$petrol=0;
$trips=0;
foreach ($cars as $car){
    echo "Автомобиль ".get_class($car).", id: ".$car->getId()."\n";
    echo "\t Потрачено бензина: ".$car->getPetrol()."\n";
    $petrol += $car->getPetrol();
    echo "\t Проехана дистанция: ". $car->getDistance()."\n";
    $distance += $car->getDistance();
    echo "\t Ежедневная поломка: ".$car->getDamadge()."% \n";
    echo "\t Поломка машины на данный момент: ".$car->getDefect()."% \n";
}
foreach ($drivers as $driver){
    echo "Водитель ".get_class($driver).", id: ".$driver->getId()."\n";
    echo "\t Выполнено ".$driver->getTrips()." поездок \n";
    $trips += $driver->getTrips();
}
echo "Общая дистанция: $distance\nВсего бензина: $petrol\nВсего поездок: $trips\n";



class Facade{
    public $car;
    public $driver;
    public $day = 0;

    public function __construct($car, $driver) {
        $this->car = $car;
        $this->driver = $driver;
    }

    /*public function __construct(string $carType, int $id, int $distance, string $driverType){
        $this->car= CarFactory::createCar($carType, $id, $distance);
        $this->driver = DriverFactory::createDriver($driverType, $id);
    }*/

    public function workOneDay(){
        $flag = true;
        $countOfTrips = $this->driver->getCountOfTrips();
        for($var = 0; $var<$countOfTrips; $var++){
            if($this->car->checkDamadge()){
                $this->car->repair();
                $countOfTrips = 0;
                $flag = false;
                break;
            }else{
                $this->driver->work();
                $this->car->delever(7, $this->driver->getFuelConsumption());
            }
        }
        if($flag){
            $this->car->finishDay();
            $this->day ++;
        }
    }

    public function work(int $days){
        for($var=0; $var<$days; $var++){
            $this->workOneDay();
        }
    }

    public function report(){
        var_dump($this->car);
        echo "+++++++++++++++++++++++++++++++++++++++++++\n";
        var_dump($this->driver);
        echo "+++++++++++++++++++++++++++++++++++++++++++\n";
        echo "Проработано дней $this->day";
    }

}



