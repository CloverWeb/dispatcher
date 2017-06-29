<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 20:29
 */

namespace Joking\Dispatcher\Support;

use Joking\Dispatcher\Functions\Container;

/**
 * Class Simple
 * @package Joking\Dispatcher\Support
 *
 * @property string $reality
 */
abstract class Simple {

    public static function __callStatic($method, $arguments) {
        $instance = static::getRealityObject();
        $methodMap = static::getMethodMap();

        //方法映射
        key_exists($method, $methodMap) && $method = $methodMap[$method];

        if (method_exists($instance, $method)) {
            return call_user_func_array([$instance, $method], $arguments);
        }

        throw new \Exception('找不到方法：' . $method);
    }

    /**
     * 真实实现的类
     * @return array|string
     */
    public abstract static function getReality();

    /**
     * 一定要设置键值对数组啊
     * @return array
     */
    public static function getMethodMap() {
        return [];
    }

    private static function getRealityObject() {
        $reality = static::getReality();
        $className = is_array($reality) ? array_shift($reality) : $reality;
        if (Container::has($className)) {
            return Container::get($className);
        }

        if (!class_exists($className)) {
            throw new \Exception('找不到对象：' . $className);
        }


        if (is_array($reality)) {
            foreach ($reality as $field => $value) {
                if (is_object($value)) {
                    continue;           //跳过这次循环
                }

                if (is_string($value) && class_exists($value)) {
                    Container::has($value) || Container::bind($value);
                    $reality[$field] = Container::get($value);
                }
            }
        }

        $instance = is_array($reality) ? Container::instance($className, $reality) : Container::instance($className);
        Container::bind($className, $instance);
        return $instance;
    }
}