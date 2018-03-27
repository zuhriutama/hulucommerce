<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\UserAddress;
use App\Models\Province;
use App\Models\City;
use App\Models\User;

class UserAddressController extends AdminController
{

    private $name = 'User Address';
    private $view = 'admin.user-address';
    private $link = 'admin/user-addresses';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = UserAddress::all();
        return view($this->view.'.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::all();
        $data['provinces'] = Province::all();
        $data['cities'] = City::all();
        return view($this->view.'.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','_method');

        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        $item = UserAddress::create($data);

        return redirect($this->link)->with('status', "Success add $this->name!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = UserAddress::find($id);

        $users = User::all();
        $provinces = Province::all();
        $cities = City::all();

        return view($this->view.'.form', compact('item', 'users', 'provinces', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        $data = $request->except('_token','_method');

        $item = User::find($id);
        $item->update($data);

        return redirect($this->link)->with('status', "Success update $this->name!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserAddress::find($id)->delete();
        return redirect($this->link)->with('status', "Success delete $this->name!");
    }
}