<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Brand::all();
       return view('admin.brand',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_brand(Request $request,$id='')
    {
        if($id>0){
            $arr=Brand::where(['id'=>$id])->get();
            $data['name']=$arr['0']->name;
$data['image']=$arr['0']->image;
            $data['id']=$arr['0']->id;
        }else{
            $data['name']="";
            $data['image']="";
            $data['id']="";
        }
        return view('admin.manage_brand',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_brand_processs(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:brands,name,'.$request->post('id')
        ]);
        
        if($request->post('id')>0){
            $model=Brand::find($request->post('id'));
            $msg="Brand name has been updated";
        }else{
            $model=new brand;
            $msg="Brand name has been added sucesssfully";
        }
        if($request->hasfile('image')){
            $image=$request->file('image'); 
            $ext=$image->extension(); //this grabs the extension from the image
            $image_name=rand(111,999).time().'.'.$ext;
            $image->storeAs('/public/media/model',$image_name);
            $model->image=$image_name;
        }
        $model->name=$request->post('name');
        $model->status=1;
        $model->save();
        $request->session()->flash('messsage',$msg);
        return redirect('admin/brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $data=Brand::find($id);
        $data->delete();
        return redirect('admin/brand');
    }
    public function status(Request $request,$type,$id)
    {
$model=Brand::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/brand');

    }
}
