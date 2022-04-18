@extends('admin.layout')
@section('brand_select','active')
@section('page_title','Manage brand')
@section('content')

<div class="main-content">
 <h1> Add brand</h1>
 <a href="{{url('admin/brand')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">

                        <div class="card-body">
                         
                            <hr>
                            <form action="{{route('brand.manage_brand_process')}}" method="post" enctype="multipart/form-data">
@csrf
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Brand Name</label>
                                    <input id="cc-name" required name="name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$name}}
                                    >
                                      @error('brand_name')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Brand Image</label>
                                    <input id="cc-name" required name="image" type="file" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$image}}
                                    >
                                      @error('name')
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