<?php

interface Cars
{
    public function delever(int $distance, float $fuelConsumption);
    public function repair();
    public function checkDamadge();
    public function finishDay();
    public function getPetrol();
    public function getDistance();
    public function getDamadge();
    public function getDefect();
    public function getId();
}

class Luda implements Cars{
    public int $id;
    public int $distance = 0;
    public float $damadge = 0.5;
    public float $defect = 0;
    public float $petrol = 0;
    public int $breakdown = 0;
    public int $damadge_control = 0;
    public function __construct(int $id, int $distance) {
        $this->id = $id;
        //$this->distance = $distance;
        $this->damadge += intdiv( $distance, 1000);
        $this->damadge_control = $distance%1000;
    }
    public function delever(int $distance, float $fuelConsumption){
        $this->distance += $distance;
        $this->petrol += $distance/10 * $fuelConsumption;
        $this->damadge_control += $distance;
        if($this->damadge_control >= 1000){
            $this->damadge += 3;
            $this->damadge_control = $this->damadge_control%1000;
        }
    }
    public function repair(){
        $this->breakdown -= 1;
    }
    public function checkDamadge(){
        if($this->breakdown == 0)
            return false;
        else return true;
    }
    public function finishDay(){
        $this->defect += $this->damadge;
        if($this->defect >= 100){
            $this->breakdown = 3;
            $this->defect = 0;
        }
    }
    public function getPetrol(){
        return $this->petrol;
    }

    public function getDistance(){
        return $this->distance;
    }

    public function getDamadge(){
        return $this->damadge;
    }
    public function getDefect(){
        return $this->defect;
    }
    public function getId(){
        return $this->id;
    }
}

class Homba implements Cars{
    public int $id;
    public int $distance = 0;
    public float $damadge = 0.5;
    public float $defect = 0;
    public float $petrol = 0;
    public int $breakdown = 0;
    public int $damadge_control = 0;
    public function __construct(int $id, int $distance) {
        $this->id = $id;
        //$this->distance = $distance;
        $this->damadge += intdiv( $distance, 1000);
        $this->damadge_control = $distance%1000;
    }
    public function delever(int $distance, float $fuelConsumption){
        $this->distance += $distance;
        $this->petrol += 7*$distance/100 * $fuelConsumption;
        $this->damadge_control += $distance;
        if($this->damadge_control >= 1000){
            $this->damadge += 1;
            $this->damadge_control = $this->damadge_control%1000;
        }
    }
    public function repair(){
        $this->breakdown -= 1;
    }
    public function checkDamadge(){
        if($this->breakdown == 0)
            return false;
        else return true;
    }
    public function finishDay(){
        $this->defect += $this->damadge;
        if($this->defect >= 100){
            $this->breakdown = 3;
            $this->defect = 0;
        }
    }
    public function getPetrol(){
        return $this->petrol;
    }

    public function getDistance(){
        return $this->distance;
    }

    public function getDamadge(){
        return $this->damadge;
    }
    public function getDefect(){
        return $this->defect;
    }
    public function getId(){
        return $this->id;
    }
}

class Hendai implements Cars{
    public int $id;
    public int $distance = 0;
    public float $damadge = 0.5;
    public float $defect = 0;
    public float $petrol = 0;
    public int $breakdown = 0;
    public int $damadge_control = 0;
    public function __construct(int $id, int $distance) {
        $this->id = $id;
        //$this->distance = $distance;
        $this->damadge += intdiv( $distance, 1000);
        $this->damadge_control = $distance%1000;
    }
    public function delever(int $distance, float $fuelConsumption){
        $this->distance += $distance;
        $this->petrol += $distance/10 * $fuelConsumption;
        $this->damadge_control += $distance;
        if($this->damadge_control >= 1000){
            $this->damadge += 1;
            $this->damadge_control = $this->damadge_control%1000;
        }
    }
    public function repair(){
        $this->breakdown -= 1;
    }
    public function checkDamadge(){
        if($this->breakdown == 0)
            return false;
        else return true;
    }
    public function finishDay(){
        $this->defect += $this->damadge;
        if($this->defect >= 100){
            $this->breakdown = 3;
            $this->defect = 0;
        }
    }
    public function getPetrol(){
        return $this->petrol;
    }

    public function getDistance(){
        return $this->distance;
    }

    public function getDamadge(){
        return $this->damadge;
    }
    public function getDefect(){
        return  $this->defect;
    }
    public function getId(){
        return $this->id;
    }
}

class CarFactory{
    public static function createCar( string $type, int $id, int $distance){
        $car = null;
        switch ($type){
            case "Luda":
                $car = new Luda($id, $distance);
                break;
            case "Homba":
                $car = new Homba($id, $distance);
                break;
            case "Hendai":
                $car = new Hendai($id, $distance);
                break;
            default:
                echo "Неверно введены данные";
        }
        return $car;
    }

}

