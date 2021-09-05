<?php

interface Driver{
    public function work();
    public function getFuelConsumption();
    public function getCountOfTrips();
    public function getTrips();
    public function getId();
}

class OrdinaryDriver implements Driver {
    public $type = 0;
    public int $id;
    public int $trips = 0;
    public int $countOfTrips = 10;
    public float $fuel = 1;
    public function __construct(int $id) {
        $this->id = $id;
    }
    public function work(){
        $this->trips++;
    }
    public function getFuelConsumption(){
        return $this->fuel;
    }
    public function getCountOfTrips(){
        return $this->countOfTrips;
    }
    public function getTrips(){
        return $this->trips;
    }
    public function getId(){
        return $this->id;
    }
}

class experiencedDriver implements Driver{
    public $type = 1;
    public int $id;
    public int $trips = 0;
    public int $countOfTrips = 13;
    public float $fuel = 0.8;
    public function __construct(int $id) {
        $this->id = $id;
    }
    public function work(){
        $this->trips++;
    }
    public function getFuelConsumption(){
        return $this->fuel;
    }
    public function getCountOfTrips(){
        return $this->countOfTrips;
    }
    public function getTrips(){
        return $this->trips;
    }
    public function getId(){
        return $this->id;
    }
}

class DriverFactory{
    public static function createDriver(string $type, int $id){
        $driver = null;
        switch ($type){
            case "default":
                $driver = new OrdinaryDriver($id);
                break;
            case "experienced":
                $driver = new experiencedDriver($id);
                break;
            default:
                echo "Неверно введены данные";
        }
        return $driver;
    }
}