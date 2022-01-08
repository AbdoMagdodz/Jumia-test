<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomerPhoneViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_phone_views');
    }

    /**
     * @return string
     */
    private function createView()
    {
        return "
             CREATE VIEW customer_phones_view AS
                SELECT customer.id, customer.name, countries.name as country_name,
                SUBSTRING(phone,LOCATE('(',phone)+1,LOCATE(')',phone)-LOCATE('(',phone)-1) AS phone_country_code,
                SUBSTRING(phone,LOCATE(')',phone)+2,LENGTH(phone)-1) AS pure_phone_number,
                IF(phone REGEXP regex, 'OK', 'NOK') as state from customer 
                INNER JOIN countries on 
                countries.code = SUBSTRING(phone,LOCATE('(',phone)+1,LOCATE(')',phone)-LOCATE('(',phone)-1)
        ";
    }
}
