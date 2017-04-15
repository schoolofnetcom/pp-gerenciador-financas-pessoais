<?php
declare(strict_types=1);
namespace SONFin\Repository;


class RepositoryFactory
{
    public static function factory(string $modelClass)
    {
        return new DefaultRepository($modelClass);
    }
}
