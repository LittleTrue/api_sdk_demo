<?php

namespace Demo\DemoClient\Base;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\RequestOptions;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Cache\Simple\RedisCache;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        //注册通讯服务
        $app['http_client'] = function ($app) {
            return new GuzzleHttp([
                RequestOptions::TIMEOUT => 60,
            ]);
        };

        //注册验证器
        $app['credential'] = function ($app) {
            return new Credential($app);
        };

        //注册身份验证器
        $app['auth'] = function ($app) {
            return new Auth($app);
        };

        //注册缓存服务
        $app['cache'] = function ($app) {
            return new RedisCache($app['config']['redis_client']);
        };
    }
}
