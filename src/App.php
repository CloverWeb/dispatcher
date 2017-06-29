<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 20:16
 */

namespace Joking\Dispatcher;


use Joking\Dispatcher\Functions\Config;
use Joking\Dispatcher\Functions\Container;
use Joking\Dispatcher\Functions\Request;
use Joking\Dispatcher\Functions\Route;
use Joking\Dispatcher\Functions\WhoopsError;
use Whoops\Handler\PrettyPageHandler;

class App {

    /**
     * 程序开始的地方
     * @param array $config 网站配置
     */
    public function start($config = []) {

        //什么都不说，先绑定配置项，之后就可以 Config::get了
        Container::bind(Config::$configName, $config);

        //debug美化插件
        $this->registerErrorPlug();

        $routeResult = Route::result(Request::method(), Request::uri());

        if ($routeResult->isOk()) {
            $result = $this->executeUserHandle($routeResult->getHandle(), $routeResult->getParam());
            if (is_string($result)) {
                return $result;
            }

            
        }

//        var_dump($routeResult->getParam());
    }

    /**
     * debug美化插件
     */
    private function registerErrorPlug() {
        if (Config::get('debug') === true) {
            WhoopsError::pushHandler(new PrettyPageHandler());
            WhoopsError::register();
        }
    }


    private function executeUserHandle($handle, $param = []) {
        if ($handle instanceof \Closure) {
            return call_user_func_array($handle, $param);
        }
    }
}