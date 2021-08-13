<?php

namespace Demo\DemoService;

use Demo\DemoClient\Application;
use Demo\DemoClient\Base\Exceptions\ClientError;

/**
 * 订单导入API服务.
 */
class demoService
{
    /**
     * @var goodClient
     */
    private $_demoClient;

    public function __construct(Application $app)
    {
        $this->_demoClient = $app['demo'];
    }

    /**
     * fixIt demo.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function fixIt(array $infos)
    {
    }
}
