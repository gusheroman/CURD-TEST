<?php require $_SERVER['DOCUMENT_ROOT'] . "/assignment/vendor/autoload.php"; ?>
<?php

use App\Models\Shipping;

$shippingObj = new Shipping;

if ($_REQUEST['action']=='delete') {
    $shippingObj->deleteShipping($_REQUEST['id']);
} 
elseif($_REQUEST['action']=='edit'){
    $shipping = $_REQUEST;
    unset($shipping['action']);
    $shippingObj->updateShipping($shipping);
   
} 
else{
    $shipping = $_REQUEST;
    unset($shipping['action']);
    unset($shipping['id']);
    $shippingObj->addShipping($shipping);
}



header("location: index.php");
?>