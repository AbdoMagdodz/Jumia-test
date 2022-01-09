<?php

namespace Tests\Unit;

use App\Models\Country;
use App\Models\Views\CustomerPhoneView;
use Tests\TestCase;

class CustomerPhoneNumbersTest extends TestCase
{
    public function testIndexPage()
    {
        $countries = Country::select('name', 'code')->get();
        $this->get('/')
            ->assertStatus(200)
            ->assertViewIs('home')
            ->assertViewHas('countries', $countries);
    }

    public function testFetchingNumbersWithoutParams()
    {
        $phones = CustomerPhoneView::paginate(10);

        $expectedResponse = [
            'body' => view('partials.phone_numbers_table', [
                'numbers' => $phones->getCollection()
            ])->render(),
            'last_page' => $phones->lastPage(),
        ];

        $this->assertResponse($expectedResponse);
    }

    public function testFetchingNumbersWithCountryCodeParam()
    {
        $countryCode = Country::inRandomOrder()->first()->code;
        $params = [
            'phone_country_code' => $countryCode
        ];
        $expectedResponse = $this->getPhonesResponse($params);
        $params = http_build_query($params);
        $this->assertResponse($expectedResponse, $params);
    }

    public function testFetchingNumbersWithInvalidCountryCodeParam()
    {
        $countryCode = "xxxx";
        $params = [
            'phone_country_code' => $countryCode
        ];
        $expectedResponse = $this->getPhonesResponse($params);
        $params = http_build_query($params);
        $this->assertResponse($expectedResponse, $params);
    }

    public function testFetchingNumbersWithNumberStateParam()
    {
        $stateOK = CustomerPhoneView::STATE_OK;
        $params = [
            'state' => $stateOK
        ];
        $expectedResponse = $this->getPhonesResponse($params);
        $params = http_build_query($params);
        $this->assertResponse($expectedResponse, $params);
    }

    public function testFetchingNumbersWithAllParams()
    {
        $countryCode = Country::inRandomOrder()->first()->code;
        $stateNOK = CustomerPhoneView::STATE_NOK;
        $params = [
            'phone_country_code' => $countryCode,
            'state' => $stateNOK
        ];
        $expectedResponse = $this->getPhonesResponse($params);
        $params = http_build_query($params);
        $this->assertResponse($expectedResponse, $params);
    }

    /**
     * @param $params
     * @return array
     */
    private function getPhonesResponse($params)
    {
        $phones = CustomerPhoneView::filter($params);
        $phones = $phones->paginate(10);
        return [
            'body' => view('partials.phone_numbers_table', [
                'numbers' => $phones->getCollection()
            ])->render(),
            'last_page' => $phones->lastPage(),
        ];
    }

    /**
     * @param $res
     * @param $params
     */
    private function assertResponse($res, $params = '')
    {
        $this->get(route('ajax_list_phones', $params))
            ->assertStatus(200)
            ->assertExactJson($res);
    }
}
