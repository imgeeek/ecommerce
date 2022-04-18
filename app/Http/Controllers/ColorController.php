<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Color::all();
       return view('admin.color',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_color(Request $request,$id='')
    {
        if($id>0){
            $arr=Color::where(['id'=>$id])->get();
            $data['color']=$arr['0']->color;

            $data['id']=$arr['0']->id;
        }else{
            $data['color']="";
            $data['id']="";
        }
        return view('admin.manage_color',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_color_process(Request $request)
    {
        $request->validate([
            'color'=>'required|unique:colors,color,'.$request->post('id')
        ]);
        
        if($request->post('id')>0){
            $model=Color::find($request->post('id'));
            $msg="color has been updated";
        }else{
            $model=new Color;
            $msg="color has been added sucesssfully";
        }
        $model->color=$request->post('color');
        $model->status=1;
        $model->save();
        $request->session()->flash('messsage',$msg);
        return redirect('admin/color');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $data=Color::find($id);
        $data->delete();
        return redirect('admin/color');
    }
    public function status(Request $request,$type,$id)
    {
$model=Color::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/color');

    }
}
