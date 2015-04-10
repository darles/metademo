<?php

namespace Acme\NewDemoBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TestCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('acme_demo.service.category')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds(
            'acme_demo.test_tag'
        );

//        $container->removeDefinition('acme_demo.service.category');

        $container->findDefinition('acme_demo.service.category')->addArgument('test_argument');
        $container->findDefinition('acme_demo.service.category')->addMethodCall('testCall', ['test_string']);

    }
}