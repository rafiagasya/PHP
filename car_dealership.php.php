<?php

class Car {
    public $make;
    public $model;
    public $price;

    public function __construct($make, $model, $price) {
        $this->make = $make;
        $this->model = $model;
        $this->price = $price;
    }

    public function displayInfo() {
        echo "{$this->make} {$this->model} - \${$this->price}\n";
    }

    public function updatePrice($newPrice) {
        $this->price = $newPrice;
    }
}

class Dealership {
    public $carsForSale = array();

    public function addCar($car) {
        $this->carsForSale[] = $car;
    }

    public function showInventory() {
        echo "Available Cars for Sale:\n";
        foreach ($this->carsForSale as $car) {
            $car->displayInfo();
        }
    }

    public function buyCar($make, $model) {
        foreach ($this->carsForSale as $key => $car) {
            if ($car->make == $make && $car->model == $model) {
                unset($this->carsForSale[$key]);
                echo "You have purchased {$car->make} {$car->model} for \${$car->price}\n";
                return;
            }
        }
        echo "Car not found\n";
    }

    public function sellCar($car) {
        $this->addCar($car);
        echo "{$car->make} {$car->model} has been added to the inventory for \${$car->price}\n";
    }

    public function updateCarPrice($make, $model, $newPrice) {
        foreach ($this->carsForSale as $car) {
            if ($car->make == $make && $car->model == $model) {
                $car->updatePrice($newPrice);
                echo "The price of {$car->make} {$car->model} has been updated to \${$newPrice}\n";
                return;
            }
        }
        echo "Car not found\n";
    }
}

// Buat dealer mobil dan tambahkan mobil
$dealer = new Dealership();
$car1 = new Car("Toyota", "Camry", 25000);
$car2 = new Car("Honda", "Civic", 22000);
$dealer->addCar($car1);
$dealer->addCar($car2);

// Tampilkan inventaris mobil yang tersedia
$dealer->showInventory();

// Pembelian mobil
$dealer->buyCar("Honda", "Civic");
$dealer->showInventory();

// Menjual mobil
$newCar = new Car("Ford", "Mustang", 30000);
$dealer->sellCar($newCar);
$dealer->showInventory();

// Memperbarui harga mobil
$dealer->updateCarPrice("Toyota", "Camry", 24000);
$dealer->showInventory();

?>
