<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class TestBase extends TestCase
{
    /**
     * @var Application 容器对象
     */
    protected $app;

    /**
     * @var array 参数
     */
    protected $config;

    /**
     * @var string 指定测试变量配置文件
     */
    protected $env = './tests/env.test';

    /**
     * @description 初始化连接参数和
     */
    public function __construct()
    {
        //兼容父类构造
        parent::__construct();
        //加载环境配置
        $this->config = Common::loadFile($this->env);
        //获取容器对象
        $this->app = Common::getApp($this->config);
    }
}
