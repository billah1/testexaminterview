<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected static $category,$imageName,$imageFile,$imageDirectory,$imageUrl;

    private  static function getImageUrl($request){
        self::$imageFile   = $request->file('image');
        self::$imageName       =  self::$imageFile->getClientOriginalName();
        self::$imageDirectory  = 'upload/category-images/';
        self::$imageFile->move(self::$imageDirectory,self::$imageName);
        self::$imageUrl         = self::$imageDirectory.self::$imageName;
        return self::$imageUrl;


    }


    public static function storecategory($request){
        if ($request->file('image')){
            self::$imageUrl   = self::getImageUrl($request);
        }else{
            self::$imageUrl   = '';
        }
        self::$category               =  new Category();
        self::saveBasicInfo(self::$category ,$request,self::$imageUrl);

    }
    public static function updatecategory($category,$request){
        if ($request->file('image')){
            if (file_exists($category->image)){
                unlink($category->image);
            }
            self::$imageUrl    = self::getImageUrl($request);
        }else{
            self::$imageUrl   = $category->image;

        }
        self::saveBasicInfo($category, $request, self::$imageUrl);

    }
    public static function saveBasicInfo($category, $request, $imageUrl){
        $category->name         = $request->name;
        $category->description  = $request->description;
        $category->image        = $imageUrl;
        $category->status       = $request->status;
        $category->save();
    }
    public static function deletecategory($category){
        if (file_exists($category->image)){
            unlink($category->image);
        }
        $category->delete();

    }



}
