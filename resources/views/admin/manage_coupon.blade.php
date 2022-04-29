@extends('admin.layout')
@section('page_title','Manage Coupon')
@section('content')
<div class="main-content">
 <h1> Add coupon</h1>
 <a href="{{url('admin/coupon')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">
                        <div class="card-body">
                            <hr>
                            <form action="{{url('admin/coupon/manage_coupon_processs')}}" method="post">
@csrf
<div class="row">
    <div class="col-md-4">
        <div class="form-group has-success">
            <label for="cc-name" class="control-label mb-1">TItle</label>
            <input id="cc-name" required name="title" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
              value={{$title}}
            >
              @error('title')
                <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-success">
            <label for="cc-slug" class="control-label mb-1">code</label>
            <input id="cc-slug" required name="code" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
            value={{$code}}
            >
            
                @error('code')
                <div class="alert alert-danger"> {{$message}} </div>
                @enderror
           
            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-success">
            <label for="cc-slug" class="control-label mb-1">Value</label>
            <input id="cc-slug" required name="value" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
            value={{$value}}
            >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="type" class="control-label mb-1">Type</label>
                            <select name="type" class="form-control" id="type">
                                @if ($type=="Value")
                                <option value="Value" selected>Value</option>
                                <option value="Per">Percentage</option>
                                @elseif($type=="Per")
                                <option value="Per" selected>Percent</option>
                                <option value="Value">Value</option>
                                @else
                                <option value="Value">Value</option>
                                <option value="Per">Percentage</option>
                                @endif
                            </select>
    </div>
    <div class="col-md-6">
        <label for="type" class="control-label mb-1">Min order amount</label>
        <input id="cc-slug" required name="min_order_amt" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
        value={{$min_order_amt}}
        >
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        
            <label for="type" class="control-label mb-1">One time coupon</label>
                                <select name="is_one_time" class="form-control" id="type">
                                    @if ($is_one_time==1)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @elseif($is_one_time==0)
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                        @else
                                        <option>Default</option>
                                        @endif
                                </select>
    </div>
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