<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-skeleton for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-skeleton/blob/master/LICENSE.md New BSD License
 */

namespace Systema\UnitTest;

use Laminas\Http\Headers;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class LocalTypeResourceTest extends AbstractHttpControllerTestCase
{

    public function setUp(): void
    {
        $configOverrides = [
            'module_listener_options' => [
                'config_cache_enabled' => false,
            ],
        ];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    private function addHeaderLines($lines=[])
    {
        $headers = new Headers();
        $headers->addHeaderLine('Accept: application/json');
        foreach ($lines as $line){
            $headers->addHeaderLine($line);
        }
        $this->getRequest()->setHeaders($headers);
    }

    public function testLocalTypeFetchAccessible()
    {
        $this->addHeaderLines();

        $this->dispatch('/local-type');
        $this->assertResponseStatusCode(200);
    }

    public function testLocalTypeFindFirst()
    {
        $this->addHeaderLines();

        $this->dispatch('/local-type/1');
        $this->assertResponseStatusCode(200);

        //$this->assertContains();
    }
}
