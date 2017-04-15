<?php
declare(strict_types=1);

namespace SONFin\Plugins;


use Interop\Container\ContainerInterface;
use SONFin\Models\BillPay;
use SONFin\Models\BillReceive;
use SONFin\Models\CategoryCost;
use SONFin\Models\User;
use SONFin\Repository\CategoryCostRepository;
use SONFin\Repository\RepositoryFactory;
use SONFin\Repository\StatementRepository;
use SONFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());
        $container->addLazy(
            'category-cost.repository', function () {
                return new CategoryCostRepository();
            }
        );

        $container->addLazy(
            'bill-receive.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillReceive::class);
            }
        );

        $container->addLazy(
            'bill-pay.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillPay::class);
            }
        );

        $container->addLazy(
            'user.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(User::class);
            }
        );

        $container->addLazy(
            'statement.repository', function () {
                return new StatementRepository();
            }
        );

    }
}
