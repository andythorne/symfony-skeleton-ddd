<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $confDir = $this->getProjectDir().'/config';

        $container->import($confDir.'/{apps}.yaml');
        $container->import($confDir.'/{apps}/*.yaml');
        $container->import($confDir.'/{apps}/'.$this->environment.'/*.yaml');
        $container->import($confDir.'/{domains}.yaml');
        $container->import($confDir.'/{domains}/*.yaml');
        $container->import($confDir.'/{domains}/'.$this->environment.'/*.yaml');
        $container->import($confDir.'/{infra}.yaml');
        $container->import($confDir.'/{infra}/*.yaml');
        $container->import($confDir.'/{infra}/'.$this->environment.'/*.yaml');
        $container->import($confDir.'/{packages}/*.yaml');
        $container->import($confDir.'/{packages}/'.$this->environment.'/*.yaml');
        $container->import($confDir.'/{services}.yaml');
        $container->import($confDir.'/{services}_'.$this->environment.'.yaml');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
