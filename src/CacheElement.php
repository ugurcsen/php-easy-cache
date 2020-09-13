<?php


namespace EasyCache;

class CacheElement extends Cache
{
    /**
     * @var string $key
     * @var integer $expiresTime
     * @var integer $fileName
     */
    public $key;
    public $expiresTime;

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param integer $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @param integer $cache <p>
     * Cache class which will use
     * </p>
     */
    public function __construct($key, $expiresTime, $cache)
    {
        $this->key = $key;
        $this->expiresTime = $expiresTime;
        $this->saveLocation = $cache->saveLocation;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param integer $expiresTime
     */
    public function setExpiresTime($expiresTime)
    {
        $this->expiresTime = $expiresTime;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return integer
     */
    public function getExpiresTime()
    {
        return $this->expiresTime;
    }

    /**
     * @return string
     */
    public function getCachedFilePath(){
        return $this->saveLocation . '/' . md5($this->key);
    }

    /**
     * @param mixed $data <p>
     * Cached data
     * </p>
     * @return boolean
     */
    public function save($data){
        return $this->set($this->key, $this->expiresTime, $data);
    }

    /**
     * @return bool
     */
    public function clear()
    {
        $key = $this->key;
        return $this->clear($key);
    }

    /**
     * @return bool
     */
    public function check()
    {
        $key = $this->key;
        return $this->check($key);
    }
}