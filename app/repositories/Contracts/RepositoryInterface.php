<?php
namespace App\repositories\Contracts;

interface repositoryInterface
{
public function create(array $data);

public function update(int $id,array $data);

public function all(array $where);

public function delete(array $where);

public function find(int $id);

public function paginate(string $search = null,int $page, int $pageSaiz = 20);

}

?>
