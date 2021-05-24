<?php
require_once '../model/Product.php';
require_once '../model/Store.php';

class ProductDB
{
    public static function getAllStores() {
        global $db;
        $query = "SELECT * FROM store";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $stores = array();

        foreach ($rows as $row) {
            $store = new Store($row['id'], $row['storeName'], $row['created'], $row['updated']);

            $stores[] = $store;
        }

        return $stores;
    }

    public static function getProductById($productId) {
        global $db;
        $query = "SELECT *
                  FROM product
                  WHERE id = '$productId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $product = new Product($row['productName'], $row['productUrl'], $row['storeName'], $row['id'], $row['created'], $row['updated']);

        return $product;
    }

    public static function insertNewProduct($product) {
        global $db;

        $query = "INSERT INTO product (productName, productUrl, storeID)
                  VALUES (:productName, :productUrl, :storeID)";

        $statement = $db->prepare($query);

        $statement->bindvalue(':productName', $product->getProductName());
        $statement->bindvalue(':productUrl', $product->getProductUrl());
        $statement->bindvalue(':storeID', $product->getStoreId());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function updateProduct($productId, $product) {
        global $db;

        $query = "UPDATE product
                  SET productName = :productName, productUrl = :productUrl, storeID = :storeID, updated = NOW()
                  WHERE id = :id";
        
        $statement = $db->prepare($query);

        $statement->bindValue(':productName', $product->getProductName());
        $statement->bindValue(':productUrl', $product->getProductUrl());
        $statement->bindValue(':storeID', $product->getStoreId());
        $statement->bindValue(':id', $product->getId());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }
}
