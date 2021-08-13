<?php

namespace Demo\DemoClient\Good;

use Demo\DemoClient\Application;
use Demo\DemoClient\Base\BaseClient;
use Demo\DemoClient\Base\Exceptions\ClientError;

/**
 * 客户端.
 */
class Client extends BaseClient
{
    /**
     * @var Application
     */
    protected $credentialValidate;

    /**
     * @var Application
     */
    protected $authAuto;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->credentialValidate = $app['credential'];
        $this->authAuto           = $app['auth'];
    }

    /**
     * fixIt.
     *
     * @throws ClientError
     */
    public function fixIt(array $infos)
    {
        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'goods'     => 'require',
                'storeUuid' => 'require',
            ]
        );

        //验证平台代码和电商代码
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError($this->credentialValidate->getError());
        }

        //获取token
        $infos['Authorization'] = $this->authAuto->token();

        //TODO -- post
    }
}
