<?php require_once '../view/header.php'; ?>

<main>
    <h3>Confirm Product</h3>

    <?php
    require_once '../model/Scraper.php';
    echo Scraper::scrapeChewy(filter_input(INPUT_POST, 'productUrl'));
    ?>

    <br>

    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="product_add">

        <input type="hidden" name="productName" value="<?php echo filter_input(INPUT_POST, 'productName'); ?>">
        <input type="hidden" name="productStoreId" value="<?php echo filter_input(INPUT_POST, 'productStoreId'); ?>">
        <input type="hidden" name="productUrl" value="<?php echo filter_input(INPUT_POST, 'productUrl'); ?>">

        <input type="submit" class="btn btn-secondary" value="Go Back">
    </form>

    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="product_add_process">

        <input type="hidden" name="productName" value="<?php echo filter_input(INPUT_POST, 'productName'); ?>">
        <input type="hidden" name="productStoreId" value="<?php echo filter_input(INPUT_POST, 'productStoreId'); ?>">
        <input type="hidden" name="productUrl" value="<?php echo filter_input(INPUT_POST, 'productUrl'); ?>">

        <input type="submit" class="btn btn-success" value="Confirm">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
