<?php

namespace Tests;

use Exception;
use YunDaDecl\common\Application;

/**
 * Class Common 统一获取基础数据和配置项.
 */
class Common
{
    const ENV_PREFIX = 'Test_';

    public static $loaded = false;

    /**
     * 根据Config配置，得到一个容器实例.
     *
     * @return Application 一个app实例
     */
    public static function getApp($config)
    {
        try {
            $app = new Application($config);
        } catch (Exception $e) {
            printf($e->getMessage() . "\n");
            return null;
        }

        return $app;
    }

    /**
     * 加载变量配置文件, 返回所有的环境变量数组, 并生效到环境变量中.
     * @param  string     $filePath 配置文件路径
     * @throws \Exception
     * @return array      $config 环境变量数组
     */
    public static function loadFile(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception('配置文件' . $filePath . '不存在');
        }

        self::$loaded = true;

        //返回二位数组
        $env = parse_ini_file($filePath, true);
        foreach ($env as $key => $val) {
            $prefix = static::ENV_PREFIX . strtoupper($key);
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    $item = $prefix . '_' . strtoupper($k);
                    putenv("{$item}={$v}");
                }
            } else {
                putenv("{$prefix}={$val}");
            }
        }

        return $env;
    }

    /**
     * 获取环境变量值
     * @param string $name    环境变量名（支持二级 . 号分割）
     * @param string $default 默认值
     */
    public static function get(string $name, $default = null)
    {
        if (!self::$loaded) {
            try {
                self::loadFile(dirname(dirname(dirname(dirname(__DIR__)))) . '/.env');
            } catch (\Exception $e) {
                return $default;
            }
        }

        $result = getenv(static::ENV_PREFIX . strtoupper(str_replace('.', '_', $name)));

        if (false !== $result) {
            if ('false' === $result) {
                $result = false;
            } elseif ('true' === $result) {
                $result = true;
            }
            return $result;
        }
        return $default;
    }
}
