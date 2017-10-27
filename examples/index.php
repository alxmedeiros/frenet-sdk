<?php
/**
 * Created by IntelliJ IDEA.
 * User: alexandre
 * Date: 27/10/17
 * Time: 00:00
 */
require ('../vendor/autoload.php');

$frenetSDK = \Frenet\Frenet::init('8220EA37R3D49R43EBR9641R17C4767DAB02');

try {

    $shippingInfo = $frenetSDK->getShippingInfo();

    print_r($shippingInfo);

} catch (Exception $ex) {
    print_r($ex);
}
