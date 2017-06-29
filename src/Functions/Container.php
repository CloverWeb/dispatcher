<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 20:18
 */

namespace Joking\Dispatcher\Functions;

/**
 * Class Container
 * @package Joking\Dispatcher\Functions
 * @see \Joking\Container\Container
 *
 * @method static object instance($className, array $properties = [])
 * @method static object get($name)
 * @method static void bind(string $abstract, $value = null)
 * @method static array all()
 * @method static void addAll(array $all)
 * @method static set(string $name, $value)
 * @method static bool has(string $name)
 */
class Container {

    private static $container;

    public static function __callStatic($method, $arguments = []) {
        if (!isset(static::$container)) {
            static::$container = new \Joking\Container\Container();
        }

        if (method_exists(static::$container, $method)) {
            return call_user_func_array([static::$container, $method], $arguments);
        }

        throw new \Exception("方法不存在！！！");
    }
}