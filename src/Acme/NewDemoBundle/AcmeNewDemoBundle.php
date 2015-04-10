<?php

namespace Acme\NewDemoBundle;

use Acme\NewDemoBundle\DependencyInjection\CompilerPass\TestCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AcmeNewDemoBundle extends Bundle
{

    /**
     * @return string
     */
    public function getParent()
    {
        return 'AcmeDemoBundle';
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TestCompilerPass());
    }

}
