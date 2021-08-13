<?php

namespace Demo\DemoClient\Base;

use Demo\DemoClient\Application;

/**
 * Auth 2.0 下的token机制处理.
 */
class Auth
{
    use MakesHttpRequests;

    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get token.
     *
     * @throws ClientError
     */
    public function token(): string
    {
        if ($value = $this->app['cache']->get($this->cacheKey())) {
            return $value;
        }

        //TO GET THE AUTH2.0 token

        $this->setToken($token = $result['body']['token'], 7000);
        return $token;
    }

    /**
     * Set token.
     *
     * @param null $ttl
     */
    public function setToken(string $token, $ttl = null): AuthAuto
    {
        $this->app['cache']->set($this->cacheKey(), $token, $ttl);

        return $this;
    }

    /**
     * Get credentials.
     */
    protected function credentials(): array
    {
        return [
            'username' => $this->app['config']->get('username'),
            'password' => $this->app['config']->get('password'),
        ];
    }

    /**
     * Get cachekey.
     */
    protected function cacheKey(): string
    {
        return md5(json_encode($this->credentials()));
    }
}
