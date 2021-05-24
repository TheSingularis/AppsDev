<?php require_once '../view/header.php'; ?>

<main>
    <!-- Forms are given values via post if a user clicks "Go Back" from the confirm page -->
    <form action="list_manager/product_confirm.php" method="post">
        <input type="hidden" name="productId" value="
        <?php
        if (isset($product)) {
            echo $product->getId();
        } else {
            echo filter_input(INPUT_POST, 'productId');
        }
        ?>">
        <input type="hidden" name="process" value="edit">
        <input type="text" name="productName" <?php echo 'value="' . ((filter_input(INPUT_POST, 'productName') != null) ? filter_input(INPUT_POST, 'productName') : '') . '"'; ?> placeholder="Product Name" class="form-control">
        <select name="productStoreId" <?php echo 'value="' . ((filter_input(INPUT_POST, 'productStoreId') != null) ? filter_input(INPUT_POST, 'productStoreId') : '') . '"'; ?> class="form-control">
            <?php
            foreach ($stores as $store) {
                echo '<option value="' . $store->getId() . '">' . $store->getStoreName() . '</option>';
            }
            ?>
        </select>
        <input type="text" name="productUrl" <?php echo 'value="' . ((filter_input(INPUT_POST, 'productUrl') != null) ? filter_input(INPUT_POST, 'productUrl') : '') . '"'; ?> placeholder="Product Url" class="form-control">

        <input type="submit" class="btn btn-primary" value="Save">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
