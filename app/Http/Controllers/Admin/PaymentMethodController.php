<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\PaymentMethod;

class PaymentMethodController extends AdminController
{

    private $name = 'Payment Method';
    private $view = 'admin.payment-method';
    private $link = 'admin/payment-methods';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PaymentMethod::all();
        return view($this->view.'.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view.'.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $item = PaymentMethod::create([
            'name' => $request->get('name'),
        ]);

        if ($request->image) {
            $photoName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/general'), $photoName);

            $item->image = 'uploads/general/'.$photoName;
        }
        
        $item->save();

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
        $item = PaymentMethod::find($id);
        return view($this->view.'.form', compact('item'));
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
            'name' => 'required',
        ]);

        $item = PaymentMethod::find($id);
        $item->name = $request->get('name') ? $request->get('name') : $item->name;

        if ($request->image) {
            $photoName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/general'), $photoName);

            $item->image = 'uploads/general/'.$photoName;
        }

        $item->save();

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
        PaymentMethod::find($id)->delete();
        return redirect($this->link)->with('status', "Success delete $this->name!");
    }
}