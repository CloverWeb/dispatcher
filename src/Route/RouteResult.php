<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 23:11
 */

namespace Joking\Dispatcher\Route;


class RouteResult {

    public $ok;

    public $handle;

    public $param;

    public function isOk() {
        return $this->ok;
    }

    public function getHandle() {
        return $this->handle;
    }

    public function getParam() {
        return $this->param;
    }
}