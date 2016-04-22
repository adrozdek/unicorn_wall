<?php

namespace App\Core;

/**
 * Class Config
 * @package App\Core
 */
class Config
{
    /**
     * @param $pathToParam
     * @return mixed|null
     */
    public function getConfig($pathToParam)
    {
        $params = explode('.', $pathToParam);

        if ($this->checkFileConfig($params[0])) {
            $config = $this->getConfigArray($params[0]);
            unset($params[0]);
            $params = array_values($params);
            return $this->getValueByPath($config, $params);
        }
        return null;
    }

    /**
     * @param $configName
     * @return mixed
     */
    public function getConfigArray($configName)
    {
        return include __DIR__ . '/../configs/' . $configName . '.php';
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public function checkFileConfig($fileName)
    {
        return file_exists(__DIR__ . '/../configs/' . $fileName . '.php');
    }

    /**
     * @param $configArray
     * @param $pathToParam
     * @return mixed|null
     */
    public function getValueByPath($configArray, $pathToParam)
    {
        if (!empty($pathToParam)) {
            if (is_array($configArray) && array_key_exists($pathToParam[0], $configArray)) {
                $configArray = $configArray[$pathToParam[0]];
                unset($pathToParam[0]);

                return $this->getValueByPath($configArray, array_values($pathToParam));
            } else {
                return null;
            }
        } else {
            return $configArray;
        }
    }
}

