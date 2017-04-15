<?php
declare(strict_types = 1);
namespace SONFin\Repository;


interface RepositoryInterface
{
    public function all(): array;

    public function find(int $id,bool $failIfNotExist = true);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function findByField(string $field,$value);

    public function findOneBy(array $search);
}
