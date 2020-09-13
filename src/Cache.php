<?php


namespace EasyCache;


class Cache
{
    /**
     * @var string $saveLocation
     */
    public $saveLocation;

    public function __construct()
    {
        $this->saveLocation = sys_get_temp_dir();
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param integer $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @return CacheElement
     */
    public function createElement($key, $expiresTime)
    {
        return new CacheElement($key, $expiresTime, $this);
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @return boolean
     */
    public function check($key)
    {
        return true;
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param integer $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @param mixed $data <p>
     * Cached data
     * </p>
     * @return boolean
     */
    public function set($key, $expiresTime, $data)
    {
        file_put_contents($this->saveLocation . '/' . md5($key), $data);
        return true;
    }

    /**
     * @return  boolean
     */
    public function clear($key)
    {
        unlink($this->saveLocation . '/' . md5($key));
        return true;
    }

    /**
     * @param string $saveLocation
     */
    public function setSaveLocation($saveLocation)
    {
        $this->saveLocation = $saveLocation;
    }

    /**
     * @return string
     */
    public function getSaveLocation()
    {
        return $this->saveLocation;
    }
}