<?php

namespace Tests\Unit;

use Demo\client\demo;
use Tests\TestBase;

/**
 * 单元测试用例。
 *
 * @internal
 * @coversNothing
 */
class DemoTest extends TestBase
{
    public function testDeclare()
    {
        $user = new demo($this->app);
        $this->assertEquals(4, $user->declare(4));
    }
}
