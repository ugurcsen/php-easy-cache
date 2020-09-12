
# Easy Cache
## Installation
```
composer require ugurcsen/php-easy-cache
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
$cache->saveLocation = '/var/temp/'; //Should be changed for operating system
```
## Cache something
```php
<?php
use EasyCache\CacheElement;
$data = "Something which needs to cached.";
$dataCache = new CacheElement('data1', 540);// Key , ExpiresTime(seconds)
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
$dataCache = new CacheElement('data1', 540);
$dataCache->save($data);//If data caching before expires date, Nothing will save

if($dataCache->check()){
	echo $dataCache->get();
}

$dataCache->clear();
```
## Create, Get And Delete without CacheElement definations
```php
<?php
use EasyCache\Cache;
$cache = new Cache();
$data = "Something which needs to cached.";
//Creating
$cache->set('data1', 540, $data);//If data caching before expires date, Nothing will save
//Getting and writing
if($cache->check('data1')){
  echo $cache->get('data1');
}
//Deleting
$cache->clear('data1');
```
