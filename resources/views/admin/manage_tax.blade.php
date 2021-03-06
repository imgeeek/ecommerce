@extends('admin.layout')
@section('page_title','Manage tax')
@section('content')
<div class="main-content">
 <h1> Add tax</h1>
 <a href="{{url('admin/tax')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">

                        <div class="card-body">
                         
                            <hr>
                            <form action="{{route('tax.manage_tax_process')}}" method="post">
@csrf
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Tax description</label>
                                    <input id="cc-name" required name="tax_desc" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$tax_desc}}
                                    >
                                      @error('tax_name')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Tax Value</label>
                                    <input id="cc-name" required name="tax_value" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$tax_value}}
                                    >
                                      @error('tax_name')
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