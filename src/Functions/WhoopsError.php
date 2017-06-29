<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 0:41
 */

namespace Joking\Dispatcher\Functions;


use Joking\Dispatcher\Support\Simple;

class WhoopsError extends Simple {

    /**
     * 真实实现的类
     * @return array|string
     */
    public static function getReality() {
        return 'Whoops\Run';
    }
}