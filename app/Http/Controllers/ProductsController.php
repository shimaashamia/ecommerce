<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;


class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $category=$request->category;
        $query = product::whereRaw('true');
        if($q){
            $query->whereRaw('(title like ? or slug like ? or details like ? )',["%$q%","%$q%","%$q%"]);
        }
        if($category){
            $query->whereIn('category_id',$category);
        }

        
        
        $products = $query->paginate(6)
        ->appends([
            'q'     =>$q,
            'category' => $category
        ]);

        $categories= category::all();       
        return view("products.index",compact('products','categories'));
        
    }
    public function details($slug)
    {
        return view('products.details');
    }
}