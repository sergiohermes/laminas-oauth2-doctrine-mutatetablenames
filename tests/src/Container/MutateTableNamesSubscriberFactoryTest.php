<?php

namespace LaminasApi\OAuth2\Doctrine\MutateTableNamesTest;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use LaminasApi\OAuth2\Doctrine\MutateTableNames\Container\MutateTableNamesSubscriberFactory;
use LaminasApi\OAuth2\Doctrine\MutateTableNames\EventSubscriber\MutateTableNamesSubscriber;
use PHPUnit\Framework\TestCase;

/**
 * @covers  \LaminasApi\OAuth2\Doctrine\MutateTableNames\Container\MutateTableNamesSubscriberFactory
 */
class MutateTableNamesSubscriberFactoryTest extends TestCase
{
    public function testCanCreateFromFactory()
    {
        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();

        $container
            ->method('get')
            ->with('config')
            ->willReturn([
                'apiskeletons-oauth2-doctrine' => [
                    'default'          => [
                        'dynamic_mapping' => []
                    ],
                    'mutatetablenames' => [
                        'default' => []
                    ]
                ]
            ])
        ;

        $factory = new MutateTableNamesSubscriberFactory();
        $service = $factory($container, 'requestedname');

        $this->assertInstanceOf(MutateTableNamesSubscriber::class, $service);
    }

    public function testCanCreateFromFactoryV2()
    {
        $container = $this->getMockBuilder(ServiceLocatorInterface::class)->getMock();

        $container
            ->method('get')
            ->with('config')
            ->willReturn([
                'apiskeletons-oauth2-doctrine' => [
                    'default'          => [
                        'dynamic_mapping' => []
                    ],
                    'mutatetablenames' => [
                        'default' => []
                    ]
                ]
            ]);

        $factory = new MutateTableNamesSubscriberFactory();
        $service = $factory->createService($container);

        $this->assertInstanceOf(MutateTableNamesSubscriber::class, $service);
    }

    public function testOmittedServiceKeyIsNot()
    {
        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();

        $container
            ->method('get')
            ->with('config')
            ->willReturn([
                'apiskeletons-oauth2-doctrine' => [
                    'default'          => [
                        'dynamic_mapping' => []
                    ],
                    'non-default'          => [
                        'dynamic_mapping' => []
                    ],
                    'mutatetablenames' => [
                        'default' => [],
                        // 'non-default' omitted on purpose
                    ]
                ]
            ]);

        $factory = new MutateTableNamesSubscriberFactory();
        $service = $factory($container, 'requestedname');

        $this->assertInstanceOf(MutateTableNamesSubscriber::class, $service);
    }
}
