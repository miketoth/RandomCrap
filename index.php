<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mtoth
 * Date: 7/19/13
 * Time: 8:47 PM
 * To change this template use File | Settings | File Templates.
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

function doCurl($url){
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
curl_close($ch);
return $result;

}

function getItems($dom){
    $items = $dom->getElementsByTagName('li');
    $itemList = array();

    // check if item has the correct class name
    $startList = false;
    $numberOfListItems = 0;
    foreach($items as $item) {

        if($numberOfListItems > 28 && $numberOfListItems < 42) {
            $itemList[] = $item;
        }

        $numberOfListItems += 1;

    }
    return $itemList;
}

$randomPage = rand(1, 1250);
echo($randomPage . '\n');

$dom = new DOMDocument();

$url =  "http://www.etsy.com/search?q=&order=price_asc&view_type=list&ship_to=US&min=1&max=15&page={$randomPage}";

echo($url . '\n');

$result = doCURL($url);
$dom->loadHTML($result);

$itemList = getItems($dom);

// now just pick one of them at random
$itemNumber = rand(0, count($itemList));

$luckyItem = $itemList[$itemNumber];

echo $luckyItem->nodeValue;


echo "done";

