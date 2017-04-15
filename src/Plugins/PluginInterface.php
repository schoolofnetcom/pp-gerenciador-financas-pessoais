<?php

namespace SONFin\Plugins;


use SONFin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}
