@extends('admin.layout')
@section('page_title','Manage Category')
@section('content')
<div class="main-content">
 <h1> Add Category</h1>
 <a href="{{url('admin/category')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">

                        <div class="card-body">
                         
                            <hr>
                            <form action="{{route('category.manage_category_process')}}" method="post">
@csrf
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Category Name</label>
                                    <input id="cc-name" required name="category_name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$category_name}}
                                    >
                                      @error('category_name')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1">Category Slug</label>
                                    <input id="cc-slug" required name="category_slug" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    value={{$category_slug}}
                                    >
                                    
                                        @error('category_slug')
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