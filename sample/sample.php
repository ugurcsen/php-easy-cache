<?php
include __DIR__ . '/../easycache.php';

use EasyCache\Cache;

$cache = new Cache();
$cache->setSaveLocation(__DIR__);

$cachedDataElement = $cache->createElement("data576", 60 /*Second*/);

$cachedDataElement->save("Data string");
var_dump($cachedDataElement->get());

sleep(65);
var_dump($cachedDataElement->get());

$cachedDataElement->save("Data string2");
var_dump($cachedDataElement->get());

$cachedDataElement->clear();
var_dump($cachedDataElement->get());