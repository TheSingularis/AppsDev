<?php

if (session_id() == '') {
    $lifetime = 60 * 60 * 24 * 7 * 2;
    //2 weeks in seconds

    session_set_cookie_params($lifetime, '/');
    session_start();
}

if (isset($_SESSION['user'])) {
    header('Location: list_manager/index.php');
}

require_once 'model/User.php';
require_once 'view/header.php';
?>

<main>

<?php 
//TODO: check which store is selected to select which scraping method to use
require_once 'addons/simplehtmldom_1_9_1/simple_html_dom.php';

$html = file_get_html('https://www.chewy.com/royal-canin-veterinary-diet/dp/35621');

//Get product images
$productImages = '<div class="slick-carousel">';
foreach ($html->find('.product-top') as $mainProduct) {
    foreach ($mainProduct->find('#left-column') as $leftColumn) {
        foreach (array_slice($leftColumn->find('a'), 1) as $imgLink) {
            if ($imgLink->href != '#') {
                $productImages .= '<img src="'.$imgLink->href.'">';
            }
        }
    }
}
$productImages .=  '</div>';
//End product images

//Get product name
$productName = '<div class="name">';
$productName .= '<h3>'.$html->getElementById('product-title')->children(0)->plaintext.'</h3>';
$productName .= '<p>'.$html->getElementById('product-title')->children(1)->plaintext.'</p>';
$productName .= '</div>';
//End product price

//Get product price
$productPrice = '<div class="price">';
foreach ($html->find('.ga-eec__price') as $priceElement) {
    $productPrice .= $priceElement;
}
$productPrice .= '</div>';
//End product price

//Get product info
$productInfo = '<div class="info">';
$productInfo .= '<h3>Description:</h3>';
foreach ($html->find('.descriptions__content') as $descriptionElement) {
    $descriptionText = $descriptionElement->children(0)->children(0);
    if (isset($descriptionText)) {
        $productInfo .= $descriptionElement->children(0)->children(0)->plaintext;
    }
}
$productInfo .= '</div>';
//End product info

//Display product block
echo '<div class="product-container">';
echo $productImages;
echo $productName;
echo $productPrice;
echo $productInfo;
echo '</div>';
//End display product block
?>

</main>

<?php require_once 'view/footer.php'; ?>
