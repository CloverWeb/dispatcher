<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 20:32
 */

namespace Joking\Dispatcher\Functions;


use Joking\Dispatcher\Support\Simple;
use Joking\Http\HttpRequest;
use Joking\Http\HttpServer;

/**
 * Class Request
 * @package Joking\Dispatcher\Functions
 * @see HttpRequest
 *
 * @method static string method
 * @method static string uri
 * @method static string url
 * @method static string get($name, $default = null)
 * @method static string input($name, $default = null)
 * @method static string post($name, $default = null)
 * @method static bool isGet
 * @method static bool isPost
 * @method static bool isAjax
 * @method static string host
 * @method static string baseUri
 * @method static int port
 * @method static file
 *
 */
class Request extends Simple {

    /**
     * 真实实现的类
     * @return array|string
     */
    public static function getReality() {
        return [HttpRequest::class, 'server' => HttpServer::class];
    }
}