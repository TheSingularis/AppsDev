<?php require_once '../view/header.php'; ?>

<main>
    <h3>View Product</h3>

    <?php 
        require_once '../model/Scraper.php';
        echo Scraper::scrapeChewy($product->getProductUrl());
    ?>
    
    <br>

    <form action="<?php echo $product->getProductUrl(); ?>" method="get" target="_blank">
        <input type="submit" value="Go To Store">
    </form>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="product_edit">
        
        <input type="hidden" name="productId" value="<?php echo $product->getId(); ?>">
        <input type="hidden" name="productName" value="<?php echo $product->getProductName(); ?>">
        <input type="hidden" name="productStoreId" value="<?php echo $product->getStoreId(); ?>">
        <input type="hidden" name="productUrl" value="<?php echo $product->getProductUrl(); ?>">

        <input type="submit" value="Edit">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
