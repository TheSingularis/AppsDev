<?php
class Store
{
    public $id;
    public $storeName;
    public $created;
    public $updated;

    //stores are preset on the database so all data is always available and no null options are required in the constructor
    public function __construct($_id, $_storeName, $_created, $_updated) {  
        $this->id = $_id;
        $this->storeName = $_storeName;
        $this->created = $_created;
        $this->updated = $_updated;
    }
    public function getId () {
        return $this->id;
    }

    public function getStoreName () {
        return $this->storeName;
    }

    public function getCreated () {
        return $this->created;
    }

    public function getUpdated () {
        return $this->updated;
    }
}
