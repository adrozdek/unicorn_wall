<?php

namespace App\Core;

class Config
{
    public function getConfig($pathToParam)
    {
        $params = explode('.', $pathToParam);

        if (file_exists(__DIR__ . '/../configs/' . $params[0] . '.php')) {
            $config = $this->getConfigArray($params[0]);
            unset($params[0]);
            $params = array_values($params);
            return $this->getValueByPath($config, $params);
        }
        return null;
    }

    public function getConfigArray($configName)
    {
        return include __DIR__ . '/../configs/' . $configName . '.php';
    }

    private function getValueByPath($configArray, $pathToParam)
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
