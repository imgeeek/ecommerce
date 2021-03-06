<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
        return view('admin.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function auth(Request $request){
        $email=$request->post('email');
        $password=$request->post('password');
// $result=Admin::where(['email'=>$email,'password'=>$password])->get();
$result=Admin::where(['email'=>$email])->first();
if($result){
    if(Hash::check($request->post('password'),$result->password)){
        $request->session()->put('ADMIN_LOGIN',true);
        $request->session()->put('ADMIN_ID',$result->id);
        return redirect('admin/dashboard');
    }else{
        $request->session()->flash('error',"Please enter valid credentials");
        return redirect('admin');
    }

}else{
    $request->session()->flash('error',"Please enter valid credentials");
    return redirect('admin');
}
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

}
