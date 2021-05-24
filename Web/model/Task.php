<?php
class Task
{
    public $id;
    public $listId;
    public $taskTypeId;
    public $description;
    public $completed;
    public $repeatTime;
    public $productId;
    public $productVolume;
    public $productPurchaseLimit;
    public $created;
    public $updated;

    public function __construct($_taskTypeId, $_description, $_completed, $_listId, $_id = null, $_repeatTime = null, $_productId = null, $_productVolume = null, $_productPurchaseLimit = null, $_created = null, $_updated = null) {
        $this->id = $_id;
        $this->listId = $_listId;
        $this->taskTypeId   = $_taskTypeId;
        $this->description  = $_description;
        $this->completed  = $_completed;
        $this->repeatTime  = $_repeatTime;
        $this->productId = $_productId;
        $this->productVolume = $_productVolume;
        $this->productPurchaseLimit = $_productPurchaseLimit;
        $this->created = $_created;
        $this->updated = $_updated;
    }

    public function getId () {
        return $this->id;
    }

    public function getListId () {
        return $this->listId;
    }

    public function getTaskTypeId () {
        return $this->taskTypeId;
    }

    public function getDescription () {
        return $this->description;
    }

    public function getCompleted () {
        return $this->completed;
    }

    public function getRepeatTime () {
        return $this->repeatTime;
    }

    public function getProductId () {
        return $this->productId;
    }

    public function getProductVolume () {
        return $this->productVolume;
    }

    public function getProductPurchaseLimit () {
        return $this->productPurchaseLimit;
    }

    public function getCreated () {
        return $this->created;
    }

    public function getUpdated () {
        return $this->updated;
    }

    public function get () {
        
    }
}
