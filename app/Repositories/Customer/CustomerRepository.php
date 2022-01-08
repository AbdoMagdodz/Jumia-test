<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @param $filters
     * @return array|mixed
     */
    public function paginate($filters)
    {
        $customersPhones = Customer::query();

        if (isset($filters['country_code']) && !empty($filters['country_code'])) {
            $customersPhones->where('phone', 'like', "(" . $filters['country_code'] . ")%");
        }

        if (isset($filters['valid_numbers']) && !empty($filters['valid_numbers'])) {
            if ($filters['valid_numbers']) {
                $customersPhones->withValidNumbers();
            } else {
                $customersPhones->withInvalidNumbers();
            }   
        }

        $customersPhones = $customersPhones->paginate(5);
        
        return [
            'html' => view('partials.phone_numbers_table', $customersPhones->getCollection()),
            'last_page' => view('partials.phone_numbers_table', $customersPhones->lastPage())
        ];
    }
}