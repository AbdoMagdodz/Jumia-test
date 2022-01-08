<?php

namespace App\Http\Controllers\CustomerPhones;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Views\CustomerPhoneView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CustomerPhonesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $countries = Country::select('code', 'name')->get();

        return view('home', compact('countries'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxListPhones(Request $request)
    {
        $phones = CustomerPhoneView::filter($request->all());
        $phones = $phones->paginate(10);

        return Response::json([
            'body' => view('partials.phone_numbers_table', [
                'numbers' => $phones->getCollection()
            ])->render(),
            'last_page' => $phones->lastPage(),
        ], 200);
    }
}
