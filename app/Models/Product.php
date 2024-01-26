<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    private static $product, $image, $imageName, $directory, $imageUrl;
    protected $fillable = ['category_id', 'name', 'price', 'quantity', 'status'];


    public static function getImageUrl($request)
    {
        if ($request->hasFile('image')) {
            self::$image        = $request->file('image');
            self::$imageName    = self::$image->getClientOriginalName();
            self::$directory    = 'upload/product-images/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl     = self::$directory . self::$imageName;
            return self::$imageUrl;
        } else {

            return null;
        }
    }


    public static function storeproduct($request)
    {
        self::$product = new Product();
        self::$product->category_id         = $request->category_id;
        self::$product->name                = $request->name;
        self::$product->price               = $request->price;
        self::$product->quantity            = $request->quantity;
        self::$product->image               = self::getImageUrl($request);
        self::$product->status              = $request->status;
        self::$product->save();

        return self::$product;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public static function updatedProduct($request, $id)
    {
        self::$product = Product::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }

        self::$product->category_id         = $request->category_id;
        self::$product->name                = $request->name;
        self::$product->price               = $request->price;
        self::$product->quantity            = $request->quantity;
        self::$product->image               = self::$imageUrl;
        self::$product->status              = $request->status;
        self::$product->save();
    }


    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);
        if (file_exists(self::$product->image))
        {
            unlink(self::$product->image);
        }
        self::$product->delete();
    }


}
