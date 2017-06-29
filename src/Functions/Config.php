<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 23:32
 */

namespace Joking\Dispatcher\Functions;


class Config {

    //配置项在容器中的名称
    public static $configName = 'config';

    public static function get($name, $default = null) {
        Container::has(static::$configName) || Container::bind(static::$configName, []);
        $config = Container::get(static::$configName);
        return isset($config[$name]) ? $config[$name] : $default;
    }

    public static function set($name, $value) {
        Container::has(static::$configName) || Container::bind(static::$configName, []);
        $config = Container::get(static::$configName);

        $config[$name] = $value;
        Container::set(static::$configName, $config);
    }
}