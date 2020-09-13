<?php


namespace EasyCache;

class CacheElement extends Cache
{
    /**
     * @var string $key
     * @var int $expiresTime
     */
    public string $key;
    public int $expiresTime;

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param int $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @param string $cacheSaveLocation <p>
     * Cache class which will use
     * </p>
     */
    public function __construct(string $key, int $expiresTime, string $cacheSaveLocation)
    {
        $this->key = $key;
        $this->expiresTime = $expiresTime;
        $this->saveLocation = $cacheSaveLocation;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param int $expiresTime
     */
    public function setExpiresTime(int $expiresTime)
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
     * @return int
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
        return parent::clearWithKey($key);
    }

    /**
     * @return bool
     */
    public function check()
    {
        $key = $this->key;
        return parent::checkWithKey($key);
    }

    /**
     * @return string|null
     */
    public function get(){
        return $this->getWithKey($this->key);
    }
}