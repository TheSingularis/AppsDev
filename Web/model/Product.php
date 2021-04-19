<?php
class Product
{
    public $id;
    public $productName;
    public $productUrl;
    public $storeId;
    public $created;
    public $updated;

    public function __construct($_productName, $_productUrl, $_storeId, $_id = null, $_created = null, $_updated = null) {
        $this->id = $_id;
        $this->productName = $_productName;
        $this->productUrl = $_productUrl;
        $this->storeId = $_storeId;
        $this->created = $_created;
        $this->updated = $_updated;
    }

    public function getId() {
        return $this->id;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getProductUrl() {
        return $this->productUrl;
    }

    public function getStoreId() {
        return $this->storeId;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getUpdated() {
        return $this->updated;
    }
}
