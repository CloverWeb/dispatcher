<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 23:28
 */

namespace Joking\Dispatcher\Functions;


use Joking\Dispatcher\Route\FastRoute;
use Joking\Dispatcher\Route\RouteResult;
use Joking\Dispatcher\Support\Simple;

/**
 * Class Route
 * @package Joking\Dispatcher\Functions
 *
 * @see FastRoute
 *
 * @method static RouteResult result(string $method, string $uri)
 */
class Route extends Simple {

    /**
     * 真实实现的类
     * @return array|string
     */
    public static function getReality() {
        return [
            FastRoute::class,
            'routeFile' => Config::get('routeFile'),
            'basePath' => Config::get('basePath')
        ];
    }
}