<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Product;
use App\Models\Image;

class ProductController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::all();
        return view('admin.product.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form');
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

        $data = $request->except('token','_method');
        $data['slug'] = str_slug($data['name']);
        $item = Product::create($data);

        if ($request->images) {
            $imgs = array();
            foreach ($data['images'] as $img) {
                $photoName = time().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $photoName);

                $imgs[] = Image::create([
                    'url' => 'uploads/products/'.$photoName
                ])->id;
            }

            $item->images()->sync($imgs);
        }

        return redirect('admin/products')->with('status', 'Success add product!');
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
        $item = Product::find($id);
        return view('admin.product.form', compact('item'));
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

        $item = Product::find($id);
        $data = $request->all();
        $data['slug'] = str_slug($data['name']);

        $item->update($data);        

        if ($request->images) {
            $imgs = array();
            foreach ($request->images as $img) {
                $photoName = time().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $photoName);

                $imgs[] = Image::create([
                    'url' => 'uploads/products/'.$photoName
                ])->id;
            }

            $item->images()->sync($imgs);
        }
        return redirect('admin/products')->with('status', 'Success update product!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect('admin/products')->with('status', 'Success delete product!');
    }
}