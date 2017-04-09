<?php
declare(strict_types = 1);

namespace SONFin\Plugins;


use Interop\Container\ContainerInterface;
use SONFin\Models\CategoryCost;
use SONFin\Repository\RepositoryFactory;
use SONFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());
        $container->addLazy('category-cost.repository', function(ContainerInterface $container){
            return $container->get('repository.factory')->factory(CategoryCost::class);
        });

    }
}