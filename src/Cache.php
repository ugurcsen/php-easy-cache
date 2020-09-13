<?php

namespace EasyCache;

class Cache
{
    /**
     * @var string $saveLocation
     */
    public string $saveLocation;
    private string $cacheFilesListName = '62ad65283e9eb5872175aff731c1afa1';

    public function __construct()
    {
        $this->saveLocation = sys_get_temp_dir();
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param int $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @return CacheElement
     */
    public function createElement(string $key, int $expiresTime)
    {
        return new CacheElement($key, $expiresTime, $this->saveLocation);
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @return boolean
     */
    public function checkWithKey(string $key)
    {
        $key = md5($key);
        $time = time();
        $list = $this->getCacheList();
        if (array_key_exists($key, $list)) {
            if ($list[$key] >= $time) {
                return true;
            } else {
                unlink($this->saveLocation . '/' . $key);
                unset($list[$key]);
                $this->putCacheList($list);
            }
        }
        return false;
    }

    /**
     * @param string $key <p>
     * This value is using to access later.
     * </p>
     * @param int $expiresTime <p>
     * When expired this cache.(Seconds)
     * </p>
     * @param mixed $data <p>
     * Cached data
     * </p>
     * @return boolean
     */
    public function set(string $key, int $expiresTime, $data)
    {
        if (!$this->checkWithKey($key)) {
            $key = md5($key);
            if (!file_put_contents($this->saveLocation . '/' . $key, $data)) {
                return false;
            }
            $list = $this->getCacheList();
            $list[$key] = time() + $expiresTime;
            $this->putCacheList($list);
        }
        return true;
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function clearWithKey(string $key)
    {
        $key = md5($key);
        $list = $this->getCacheList();
        if (array_key_exists($key, $list)) {
            unlink($this->saveLocation . '/' . $key);
            unset($list[$key]);
            $this->putCacheList($list);
            return true;
        }
        return false;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getWithKey(string $key)
    {
        if ($this->checkWithKey($key)){
            return file_get_contents($this->saveLocation . '/' . md5($key));
        }
        return null;
    }

    /**
     * @param string $saveLocation
     */
    public function setSaveLocation(string $saveLocation)
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

    /**
     * @return null|array
     */
    public function getCacheList()
    {
        $data = [];

        if (file_exists($this->saveLocation . '/' . $this->cacheFilesListName)) {
            $data = file_get_contents($this->saveLocation . '/' . $this->cacheFilesListName);
            $data = json_decode($data, true);

        }
        return $data;
    }

    /**
     * @param array $data
     * @return bool
     */
    private function putCacheList(array $data)
    {
        //Data format = [md5key, expiresTime]
        $data = json_encode($data);
        if (!file_put_contents($this->saveLocation . '/' . $this->cacheFilesListName, $data)) {
            return false;
        }
        return true;
    }
}