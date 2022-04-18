<?php
// comments
// While submitting the form during the update process, everything gets updated except description
// description has been given name of descr.
// * ? Important functionality to be fixed //

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Product::all();
       return view('admin.product',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request,$id='')
    {
        if($id>0){
            $arr=product::where(['id'=>$id])->get();
            //the array has been checked by using print_r and looking wheere the array lies 
            $data['category_id']=$arr['0']->category_id;
            $data['name']=$arr['0']->name;
            $data['image']=$arr['0']->image;
            $data['slug']=$arr['0']->slug;
            $data['brand']=$arr['0']->brand;
            $data['model']=$arr['0']->model;
            $data['short_desc']=$arr['0']->short_desc;
            $data['descr']=$arr['0']->descr;
            $data['keywords']=$arr['0']->keywords;
            $data['technical_specification']=$arr['0']->technical_specification;
            $data['uses']=$arr['0']->uses;
            $data['warranty']=$arr['0']->warranty;
            $data['status']=$arr['0']->status;
            $data['id']=$arr['0']->id;
            $data['productsAttrArr']=DB::table('products_attr')->where(['products_id'=>$id])->get(); 
            $productsImagesArr=DB::table('products_images')->where(['products_id'=>$id])->get(); 
            if(!isset($productsImagesArr[0])){
                $data['productImagesArr']['0']['id']="";
                $data['productImagesArr']['0']['images']="";
            }else{
              $data['productImagesArr']=$productsImagesArr;
            }
        }else{
            $data['category_id']="";
            $data['name']="";
            $data['image']="";
            $data['slug']="";
            $data['model']="";
            $data['short_desc']="";
            $data['descr']="";
            $data['keywords']="";
            $data['technical_specification']="";
            $data['uses']="";
            $data['warranty']="";
            $data['status']="";
            $data['id']="";
            $data['productsAttrArr']['0']['id']="";
            $data['productsAttrArr']['0']['products_id']="";
            $data['productsAttrArr']['0']['sku']="";
            $data['productsAttrArr']['0']['attr_image']="";
            $data['productsAttrArr']['0']['mrp']="";
            $data['productsAttrArr']['0']['price']="";
            $data['productsAttrArr']['0']['qty']="";
            $data['productsAttrArr']['0']['size_id']="";
            $data['productsAttrArr']['0']['color_id']="";

            $data['productsImagesArr']['0']['id']="";
            $data['productsImagesArr']['0']['images']="";
        }
        $data['category']=DB::table('categories')->where(['status'=>1])->get(); //to get the category dropdown
$data['color']=DB::table('colors')->where(['status'=>1])->get();
$data['size']=DB::table('sizes')->where(['status'=>1])->get();
$data['brand']=DB::table('brands')->where(['status'=>1])->get();
        return view('admin.manage_product',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {
// return $request->post();
// die();
//sandesh
 if($request->post('id')>0){
$image_validation="mimes:jpeg,jpg,png";
 }else{
$image_validation="required|mimes:jpeg,jpg,png";
 }
        $request->validate([
            'name'=>'required',
            // in the mime type user can upload onnly mentioned image format
            'image'=>$image_validation,
            'slug'=>'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*'=>'mimes:jpg,jpeg,png',
            'images.*'=>'mimes:jpg,jpeg,png'

        ]);
        //sku validation
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
    
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');
        foreach($skuArr as $key=>$val){
            $check=DB::table('products_attr')->where('sku','=',$skuArr[$key])->where('id','!=',$paidArr[$key])->get();
            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }
        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg="product has been updated";
        }else{
            $model=new product;
            $msg="product has been added sucesssfully";
        }
        if($request->hasfile('image')){
            $image=$request->file('image'); 
            $ext=$image->extension(); //this grabs the extension from the image
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }
        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=$request->post('slug');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->descr=$request->post('descr');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->status=1;
        $model->save();
        $pid=$model->id;
    
        // product Attrribute starting from hreer
        
        foreach($skuArr as $key=>$val){
            $productsAttrArr['products_id']=$pid;
            $productsAttrArr['sku']=$skuArr[$key];
            if($request->hasFile("attr_image.$key")){
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension(); //this grabs the extension from the image
            $image_name=time().'.'.$ext;
            $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
            $productsAttrArr['attr_image']=$image_name;
            }
            // else{
            //     $productAttrArr['attr_image']="";
            // }
            $productsAttrArr['mrp']=$mrpArr[$key];
            $productsAttrArr['price']=$priceArr[$key];
            $productsAttrArr['qty']=$qtyArr[$key];
            if($size_idArr[$key]==""){
                $productsAttrArr['size_id']=0;
            }else{
                $productsAttrArr['size_id']=$size_idArr[$key];
            }
          
            if($color_idArr[$key]==""){
                $productsAttrArr['color_id']=0;
            }else{
                $productsAttrArr['color_id']=$color_idArr[$key];
            }
          
            if($paidArr[$key]!=""){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productsAttrArr);
            }else{
                DB::table('products_attr')->insert($productsAttrArr);
            }
         
           
        }
        $piidArr=$request->post('piid');
        foreach($piidArr as $key=>$val){
            $productsImagesArr['products_id']=$pid;
            if($request->hasFile("images.$key")){
                $images=$request->file("images.$key");
                $ext=$images->extension(); //this grabs the extension from the image
            $image_name=time().'.'.$ext;
            $request->file("images.$key")->storeAs('/public/media',$image_name);
            $productsImagesArr['images']=$image_name;
            }
            if($piidArr[$key]!=""){
                DB::table('products_images')->where(['id'=>$piidArr[$key]])->update($productsImagesArr);
            }else{
                DB::table('products_images')->insert($productsImagesArr);
            }
        }
        $request->session()->flash('messsage',$msg);
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $data=Product::find($id);
        $data->delete();
        return redirect('admin/product');
    }
    public function deleting(Request $request,$id,$cid)
    {
        DB::table('products_attr')->where(['id'=>$id])->delete();
        return redirect('admin/product/manage_product/edit/'.$cid);
    }
    public function deleting_images(Request $request,$id,$cid)
    {
        DB::table('products_images')->where(['id'=>$id])->delete();
        return redirect('admin/product/manage_product/edit/'.$cid);
    }
    public function status(Request $request,$type,$id)
    {
$model=Product::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/product');

    }
}
