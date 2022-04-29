<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Customer::all();
       return view('admin.customer',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_Customer(Request $request,$id='')
    {
        if($id>0){
            $arr=Customer::where(['id'=>$id])->get();
            $data['customer']=$arr['0']->customer;

            $data['id']=$arr['0']->id;
        }else{
            $data['customer']="";
            $data['id']="";
        }
        return view('admin.manage_customer',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function status(Request $request,$type,$id)
    {
$model=Customer::find($id);
$model->status=$type;
$model->save();
$request->session()->flash('message','Item Activated');
return redirect('admin/customer');

    }
}
