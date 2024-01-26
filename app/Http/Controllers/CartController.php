<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public static $product;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('frontend.cart.index',[
            'products' => Cart::content()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       self::$product = Product::find($request->id);
        Cart::add([
            'id' => $request->id,
            'name' => self::$product->name,
            'qty' => $request->qty,
            'price' => self::$product->price,
            'options' =>
                [
                    'image' => self::$product->image,
                   
                ]
        ]);
        return redirect(route('cart.index'))->with('message','cart added sucessfully..');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::remove($id);
        return back()->with('message','cart product remove sucessfully..');
    }

    public function delete(string $rowId)
    {
        Cart::remove($rowId);
        return back()->with('message','cart product remove sucessfully..');
    }
    public function updateProduct(Request $request)
    {
         foreach ($request->data as $item){
             Cart::update($item['rowId'],$item['qty']);
         }
        return redirect('/cart')->with('message','cart product update sucessfully..');
    }
}
