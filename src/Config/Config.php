<?php

namespace Ody\Core\Config;

class Config
{
    /**
     * @var Config
     */
    protected static self $instance;

    /**
     * @var array
     */
    protected array $fileCache = [];

    /**
     * @var array
     */
    protected array $keyCache = [];

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    /**
     * @param string $key
     * @param string|int|bool|array|float|null $default
     * @return string|int|bool|array|float|null
     */
    public function get(string $key, string|int|bool|array|float|null $default = null): string|int|bool|array|float|null
    {
        $key = \explode('.' , $key);
        $configPath = $key[0];
        unset($key[0]);
        $key = \implode('.' , $key);

        $config = $this->fileCache[$configPath] ?? ($this->fileCache[$configPath] = require_once configPath("$configPath.php"));

        if ($key == ''){
            return $config;
        }

        return $this->keyCache["$configPath.$key"] ?? ($this->keyCache["$configPath.$key"] = $this->getData($config, $key, $default));
    }

    /**
     * @param array $array
     * @param string $key
     * @param string|int|bool|array|float|null $default
     * @return string|int|bool|array|float|null
     */
    protected function getData(array $array, string $key, string|int|bool|array|float|null $default = null): string|int|bool|array|float|null
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (!str_contains($key, '.')) {
            return $array[$key] ?? value($default);
        }

        foreach (explode('.', $key) as $segment) {
            if (array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }

        return $array;
    }
}