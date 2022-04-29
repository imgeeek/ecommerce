<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class taxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Tax::all();
       return view('admin.tax',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_tax(Request $request,$id='')
    {
        if($id>0){
            $arr=Tax::where(['id'=>$id])->get();
            $data['tax_desc']=$arr['0']->tax_desc;
            $data['tax_value']=$arr['0']->tax_value;
            $data['id']=$arr['0']->id;
        }else{
            $data['tax_desc']="";
            $data['tax_value']="";
            $data['id']="";
        }
        return view('admin.manage_tax',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_tax_processs(Request $request)
    {
        $request->validate([
            'tax_value'=>'required|unique:taxes,tax_value,'.$request->post('id')
        ]);
        
        if($request->post('id')>0){
            $model=Tax::find($request->post('id'));
            $msg="tax has been updated";
        }else{
            $model=new Tax;
            $msg="tax has been added sucesssfully";
        }
        
        $model->tax_desc=$request->post('tax_desc');
        $model->tax_value=$request->post('tax_value');
        $model->status=1;
        $model->save();
        $request->session()->flash('messsage',$msg);
        return redirect('admin/tax');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tax $tax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $data=Tax::find($id);
        $data->delete();
        return redirect('admin/tax');
    }
    public function status(Request $request,$type,$id)
    {
$model=Tax::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/tax');
    }
}
