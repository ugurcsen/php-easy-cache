<?php
include __DIR__.'/../easycache.php';
use EasyCache\Cache;
use EasyCache\CacheElement;
$a = new Cache();
$c = $a->createElement("sa1",120);
print_r($c->check());
