<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 22:39
 */

namespace Joking\Dispatcher\Route;


use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Joking\Dispatcher\Functions\Config;
use Joking\Dispatcher\Functions\Container;

class FastRoute {

    //根目录
    public $basePath;

    //路由文件
    public $routeFile;

    //插件需要执行的方法，神经吧，方法都带namespace了
    public $fastMethod = 'FastRoute\simpleDispatcher';

    /**
     * @param $uri
     * @param $method
     * @return RouteResult
     * @throws \Exception
     */
    public function result($method, $uri) {
        $routeFile = Config::get('basePath') . $this->routeFile;
        if (!is_file($routeFile)) {
            throw new \Exception('缺少route文件');
        }

        $dispatcher = call_user_func($this->fastMethod, function (RouteCollector $route) use ($routeFile) {
            require_once $routeFile;
        });

        $routeResult = $dispatcher->dispatch($method, $uri);
        $status = array_shift($routeResult);

        if ($status === Dispatcher::FOUND) {
            $depend = ['ok' => true, 'handle' => $routeResult[0], 'param' => $routeResult[1]];
        } else {
            $depend = ['ok' => false];
        }
        return Container::instance(RouteResult::class, $depend);
    }

}