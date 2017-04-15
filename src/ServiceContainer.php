<?php
/**
 * Created by PhpStorm.
 * User: Luiz
 * Date: 29/03/2017
 * Time: 12:09
 */

namespace SONFin;


use Xtreamwayz\Pimple\Container;

class ServiceContainer implements ServiceContainerInterface
{

    private $container;

    /**
     * ServiceContainer constructor.
     *
     * @param $container
     */
    public function __construct()
    {
        $this->container = new Container();
    }


    public function add(string $name, $service)
    {
        $this->container[$name] = $service;
    }

    public function addLazy(string $name, callable $callable)
    {
        $this->container[$name] = $this->container->factory($callable);
    }

    public function get(string $name)
    {
        return $this->container->get($name);
    }

    public function has(string $name)
    {
        return $this->container->has($name);
    }
}
