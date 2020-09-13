
# Easy Cache
## Required
```
PHP >= 7.4
```
## Installation
```
composer require ugurcsen/phpeasycache
```
   or

```php
<?php
require 'path/to/php-easy-cache/easycache.php';
```
## Configration
```php
<?php
use EasyCache\Cache;
$cache = new Cache();
$cache->saveLocation = '/var/temp'; //Should be changed for operating system but not necessary
```
## Cache something
```php
<?php
use EasyCache\CacheElement;
$data = "Something which needs to cached.";
$dataCache = $cache->createElement('data1', 540);// Key , ExpiresTime(seconds)
$dataCache->save($data);//If data caching before expires date, Nothing will save
```
## Get something from cache
```php
<?php
$cachedData = $dataCache->get();//Getting cached data
if($cachedData != null){
	echo $cachedData;
}
```
Or
```php
<?php
if($dataCache->check()){//Checking cached data is exsist
	echo $dataCache->get();
}
```
## Delete something cached
```php
<?php
$dataCache->clear();//Deleting cached data
```
## Full Sample
```php
<?php
use EasyCache\Cache;
use EasyCache\CacheElement;
$cache = new Cache();

$data = "Something which needs to cached.";
$dataCache = $cache->createElement('data1', 540);
$dataCache->save($data);//If data caching before expires date, Nothing will save

if($dataCache->check()){
	echo $dataCache->get();
}

$dataCache->clear();
```
## Create, Get And Delete without element definition
```php
<?php
use EasyCache\Cache;
$cache = new Cache();
$data = "Something which needs to cached.";
//Creating
$cache->set('data1', 540, $data);//If data caching before expires date, Nothing will save
//Getting and writing
if($cache->checkWithKey('data1')){
  echo $cache->getWithKey('data1');
}
//Deleting
$cache->clearWithKey('data1');
```
