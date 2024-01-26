<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller

{
    private $product;
    public function index(){
        return view('frontend.home.home',[
            'products' => Product::where('status', 1)
                ->orderBy('id', 'desc')
                ->take(8)
                ->get(['id', 'name', 'image', 'price']),
        ]);
    }

    public function category($id){
        return view('frontend.category.index',[
            'products' => Product::where('category_id',$id)->orderBy('id','desc')->get(['id','name','image','price']),
        ]);
    }
    public function product($id){
        $this->product = Product::find($id);
        return view('frontend.product.index',
            [
                'product'            => $this->product,
                'category_products' => Product::where('category_id', $this->product->category_id)->orderBy('id', 'desc')->take(4)->get(['id', 'name', 'image', 'price'])
            ]);
    }
}
