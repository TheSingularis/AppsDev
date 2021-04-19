<?php
class Scraper
{
    public static function scrapeChewy($url) {
        
        include_once '../addons/simplehtmldom_1_9_1/simple_html_dom.php';
        
        $html = file_get_html($url);

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
        $productListing = '<div class="product-container">';
        $productListing .= $productImages;
        $productListing .= $productName;
        $productListing .= $productPrice;
        $productListing .= $productInfo;
        $productListing .= '</div>';
        //End display product block
            
        return $productListing;
    }
}
