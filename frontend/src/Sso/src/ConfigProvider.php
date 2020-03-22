<?php

declare(strict_types=1);

namespace Sso;

use Sso\Handler\Login;
use Sso\Handler\LoginFactory;

/**
 * The configuration provider for the sso module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                //'translate' => Translat
            ],
            'factories'  => [
                Login::class => LoginFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'sso'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
