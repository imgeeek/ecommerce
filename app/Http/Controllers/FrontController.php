<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class FrontController extends Controller
{

    public function index()
    {
        $data['home_categories']=DB::table('categories')->where(['status'=>1])->get();
        // foreach($data['home_categories'] as $item){
        //     $data['home_categories'][$item->id]=DB::table('products')->where(['status'=>1])->where(['category_id'=>$item->id])->get();
    
        //  $data['home_categories'][$item->id] that thing get all the products from in each category cat 1 get a;; product from cat 1 tbale.
        foreach($data['home_categories'] as $item){
            $data['home_categories_product'][$item->id]=DB::table('products')->where(['status'=>1])->where(['category_id'=>$item->id])->get();

            foreach($data['home_categories_product'][$item->id] as $item1){
                $data['home_product_attr'][$item1->id]=DB::table('products_attr')->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')->where(['products_attr.products_id'=>$item1->id])->get();
              
            }
        }

return view('front.index',$data);
}
}
