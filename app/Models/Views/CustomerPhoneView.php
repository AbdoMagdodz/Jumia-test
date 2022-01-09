<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPhoneView extends Model
{
    use HasFactory;

    protected $table = 'customer_phones_view';

    CONST STATE_OK = 'OK';
    CONST STATE_NOK = 'NOK';

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filter(array $data)
    {
        $query = CustomerPhoneView::query();
        $fields = ['phone_country_code', 'state'];

        foreach ($fields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $query->where($field, $data[$field]);
            }
        }

        return $query;
    }
}
