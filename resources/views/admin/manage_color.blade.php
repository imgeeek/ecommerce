@extends('admin.layout')
@section('page_title','Manage color')
@section('content')
<div class="main-content">
 <h1> Add color</h1>
 <a href="{{url('admin/color')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">

                        <div class="card-body">
                         
                            <hr>
                            <form action="{{route('color.manage_color_process')}}" method="post">
@csrf
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">color</label>
                                    <input id="cc-name" required name="color" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$color}}
                                    >
                                      @error('color_name')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                              
                               <input type="hidden" name="id" value={{$id}}>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Sandesh Neupane  || FREE WORLD for everyone</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection