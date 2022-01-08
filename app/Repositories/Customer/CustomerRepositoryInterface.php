<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    /**
     * @param $filters
     * @return mixed
     */
    public function paginate($filters);
}