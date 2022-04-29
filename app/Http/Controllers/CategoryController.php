<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Category::all();
       return view('admin.category',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request,$id='')
    {
        if($id>0){
            $arr=Category::where(['id'=>$id])->get();
            $data['category_name']=$arr['0']->category_name;
            $data['category_slug']=$arr['0']->category_slug;
            $data['parent_category_id']=$arr['0']->parent_category_id;
            $data['category_image']=$arr['0']->category_image;
            $data['id']=$arr['0']->id;
            $data['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get(); //to get the category dropdown
        }else{
            $data['category_name']="";
            $data['category_slug']="";
            $data['parent_category_id']="";
            $data['category_image']="";
            $data['id']="";
            $data['category']=DB::table('categories')->where(['status'=>1])->get(); //to get the category dropdown
            
        }
        
        return view('admin.manage_category',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_category_process(Request $request)
    {
 
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id')
        ]);
       
        
        if($request->post('id')>0){
            $model=Category::find($request->post('id'));
            $msg="Category has been updated";
        }else{
            $model=new Category;
            $msg="Category has been added sucesssfully";
        }
        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');
        $model->parent_category_id=$request->post('parent_category_id');
         //for_image
         if($request->hasfile('category_image')){
            if($request->post('id')>0){
                $arrImage=DB::table('categories')->where(['id'=>$request->post('id')])->get();
              if(Storage::exists('/public/media/category'."/".$arrImage[0]->category_image)){
                Storage::delete('/public/media/category'."/".$arrImage[0]->category_image);
              }
            }
            $image=$request->file('category_image'); 
            $ext=$image->extension(); //this grabs the extension from the image
            $image_name=rand(1111,9999).time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->category_image=$image_name;
        }
        $model->status=1;
        $model->save();
        $request->session()->flash('messsage',$msg);
        return redirect('admin/category');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $data=Category::find($id);
        $data->delete();
        return redirect('admin/category');
    }
    public function status(Request $request,$type,$id)
    {
$model=Category::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/category');

    }
}
