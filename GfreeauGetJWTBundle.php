<?php

namespace Gfreeau\Bundle\GetJWTBundle;

use Gfreeau\Bundle\GetJWTBundle\DependencyInjection\Security\Factory\GetJWTFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GfreeauGetJWTBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        /** @var SecurityExtension $extension */
        $extension = $container->getExtension('security');
        
        // Will will just return here until we fix the other issues in the bundle 
        // with 5.4 and later compatibility.
        $extension->addSecurityListenerFactory(new GetJWTFactory());
        return;
        
        // Authenticator factory for Symfony 5.4 and later
        if (method_exists($extension, 'addAuthenticatorFactory')) {
            $extension->addAuthenticatorFactory(new GetJWTFactory());

            return;
        }

        // Security listener factory for Symfony 5.3 and earlier
        if (method_exists($extension, 'addSecurityListenerFactory')) {
            $extension->addSecurityListenerFactory(new GetJWTFactory());

            return;
        }
    }
}
