<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfig()
    {
        $config = new \App\Core\Config();
        $stub = $this->getMock('\App\Core\Config');
        $configArray = [
            'host' => [
                'param1' => 'localhost',
                'param2' => 'localhost2',
                'param3' => [
                    'trzy' => 'localhost33',
                    'trzy2' => 'localhost34',
                    'trzy3' => [
                        'loc' => 'loc45',
                        'loc2' => 'loc46',
                    ],
                ],
            ],
            'user' => 'root',
            'password' => '',
            'name' => 'unicorn_wall',
        ];

        $stub->method('checkFileConfig')
            ->willReturn(true);

        $stub->method('getConfigArray')
            ->willReturn($this->returnValueMap($configArray));

        $this->assertEquals(null, $config->getConfig('db.host.param1.bl'));
        $this->assertEquals(null, $config->getConfig('db.hosdfgt.param1.bl'));
        $this->assertEquals(null, $config->getConfig('db.user.buka'));
        $this->assertInternalType('array', $config->getConfig('db.host'));
        $this->assertInternalType('string', $config->getConfig('db.user'));
        $this->assertEquals('loc45', $config->getConfig('db.host.param3.trzy3.loc'));
        $this->assertContains('unicorn_wall', $config->getConfig('db.name'));
        $this->assertEquals($configArray, $config->getConfig('db'));
    }
}