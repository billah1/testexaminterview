<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Jobs\NewProductEmailJob;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $product;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.product.manage', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product.create',[
            'categories'     => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->product   = Product::storeproduct($request);
        NewProductEmailJob::dispatch($this->product);
        return redirect()->route('product.index')->with('message','product Create sucessfully....');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.product.show',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('backend.product.edit',[
            'product' => $product,
            'categories'     => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Product::updatedProduct($request,$id);
        return redirect()->route('product.index')->with('message','product Update sucessfully....');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::deleteProduct($id);
        return redirect()->route('product.index')->with('message', 'Product info delete successfully.');
    }


    public function import(Request $request)
    {
        $file = $request->file('import');

        // Import data from the Excel file using the PatientsImport class
        Excel::import(new ProductsImport(), $file);

        return redirect()->back()->with('message', 'Products imported successfully');
    }


    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
