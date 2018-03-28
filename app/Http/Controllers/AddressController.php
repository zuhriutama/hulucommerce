<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;

class AddressController extends Controller
{

    public function getCity(Request $request)
    {
        $province_id = $request->get('province_id');
        $city = array();

        $cities = City::where('province_id',$province_id)->get();

        return response()->json($cities);
    }

    public function add(Request $request)
    {
        $data = $request->except('_token','_method');
        $data['user_id'] = \Auth::user()->id;
        $address = UserAddress::create($data);

        return back()->with('payment_address_id',$address->id);
    }
}
