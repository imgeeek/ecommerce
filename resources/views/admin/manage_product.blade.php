@extends('admin.layout')
@section('page_title','Manage product')
@section('content')
@if ($id>0)
    {{$required=""}}
    @else
    {{$required="required"}}
@endif

<div class="main-content"> 
 <h1> Add product</h1>
 @error('attr_image.*')
<div class="alert alert-danger text-align-center">
 <p class="text-align-center">
     {{$message}}
 </p>
</div>
@enderror

@error('images.*')
<div class="alert alert-danger text-align-center">
 <p class="text-align-center">
     {{$message}}
 </p>
</div>
@enderror
 <a href="{{url('admin/product')}}"><button type="button" class="btn btn-success">Back</button></a>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="card">
                        <div class="card-body">
                            <hr>
                            <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-group has-success">
                                    <label for="cc-name" class="control-label mb-1">Name</label>
                                    <input id="cc-name" required name="name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                      value={{$name}}
                                    >
                                      @error('product_name')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Slug</label>
                                    <input id="cc-slug" required name="slug" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    value={{$slug}}
                                    >
                                        @error('product_slug')
                                        <div class="alert alert-danger"> {{$message}} </div>
                                        @enderror
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Image</label>
                                    <input id="cc-slug"  name="image" type="file" class="form-control cc-name valid" {{$required}} >
                                </div>
                                <div class="form-group has-success">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="cc-slug" class="control-label mb-1"> Category</label>
                                            <select name="category_id" id="" class="form-control cc-name valid">
                                                <option value="">Select Categories</option>
                                                @foreach ($category as $item)
                                                @if($category_id==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->category_name}}</option>
                                                @endif
                                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cc-slug" class="control-label mb-1"> Model</label>
                                            <input id="cc-slug" name="model" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                            value={{$model}}
                                            >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cc-slug" class="control-label mb-1"> Brands</label>
                                            <select name="brand" id="" class="form-control cc-name valid">
                                                <option value="">Select Categories</option>
                                                @foreach ($brand as $item)
                                                @if($brand==$item->name)
                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                @endif
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        


                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Short description</label>
                                    <textarea name="short_desc" id="" cols="10" rows="5" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    >{{$short_desc}}</textarea>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Description</label>
                                    <textarea name="descr"  cols="10" rows="5" class="form-control cc-name valid"
                                    >{{$descr}}</textarea>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Keywords</label>
                                    <textarea name="keywords" id="" cols="10" rows="5" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    >{{$keywords}}</textarea>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Technical specification</label>
                                    <textarea name="technical_specification" id="" cols="10" rows="5" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    >{{$technical_specification}}</textarea>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Uses</label>
                                    <textarea name="uses" id="" cols="10" rows="5" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    >{{$uses}}</textarea>
                                </div>
                                <div class="form-group has-success">
                                    <label for="cc-slug" class="control-label mb-1"> Warranty</label>
                                    <textarea name="warranty" id="" cols="10" rows="5" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                    >{{$warranty}}</textarea>
                                </div>
                               <input type="hidden" name="id" value={{$id}}>

                               {{-- * ! From here starts the attribute section --}}
                               @if(session()->has('sku_error'))
                               <div class="alert alert-danger text-align-center">
                                <p class="text-align-center">
                                    {{session('sku_error')}}
                                </p>
                               </div>
                               @endif
                               <h2>Images Attribute</h2>
                               <div class="row" >
                                @php
                                 $loop_count_num=1;
                                 
                                @endphp
                                @foreach ($productsImagesArr as $key=>$val)
                               @php
                                 $loop_count_prev=$loop_count_num;
                                   $pIArr=(array)$val;
                         
                               @endphp
                                <div class="col-lg-12">
                                    <div class="card">
                                     <div class="form-group">
                                         <div class="row" id="images_box">
                                             <input id="cc-slug" value="{{$pIArr['id']}}" name="piid[]" type="hidden" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card">
                                             
                                             
                                             <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                                                 <label for="cc-slug" class="control-label mb-1"> Image</label>
                                                 <input  value={{$pIArr['images']}} id="cc-slug"  name="images[]" type="file" class="form-control cc-name valid" >
                                                 @if($pIArr['images']!="")
                                                 <img width="150" src="{{asset('storage/media/'.$pIArr['images'])}}" alt="">
                                                 @endif
                                             </div>
                                            
                                             @if($loop_count_num==2)
                                             <div>
                                                 <button onclick="add_image_more()"
                                                 id="payment-button" type="button" class="btn btn-lg btn-info btn-success m-t-30"><i class="fa fa-plus "></i>
                                                Add Images </button>
                                             </div>
                                             @else
                                           
                                             <div>
                                             <a href="{{url('admin/product/products_images/delete/'.$pIArr['id']).'/'.$id}}">
                                                 <button onclick="remove_image({{$loop_count_prev}})"
                                                 id="payment-button" type="button" class="btn btn-lg btn-info btn-danger m-t-30"><i class="fa fa-minus "></i>
                                                Remove attribute </button>    
                                             </a>    
                                             </div>
                                             @endif
                                           
                                         </div>
                                     </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                               <h2 class="ml-50">Products Atribute</h2>
                               <div class="row" id="at_box">
                                   @php
                                    $loop_count_num=1;
                                    
                                   @endphp
                                   @foreach ($productsAttrArr as $key=>$val)
                                  @php
                                    $loop_count_prev=$loop_count_num;
                                      $pAArr=(array)$val;
                            
                                  @endphp
                                   <div class="col-lg-12" id="product_attr_{{$loop_count_num++}}">
                                       <div class="card">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="cc-slug" class="control-label mb-1"> price</label>
                                                    <input id="cc-slug" name="price[]" type="text" class="form-control cc-name valid" value="{{$pAArr['price']}}" />
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="cc-slug" class="control-label mb-1"> MRP</label>
                                                    <input id="cc-slug" value="{{$pAArr['mrp']}}" name="mrp[]" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card">
                                                </div>
                                                <input id="cc-slug" value="{{$pAArr['id']}}" name="paid[]" type="hidden" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card">

                                                <div class="col-md-2">
                                                    <label for="cc-slug" class="control-label mb-1"> SKU</label>
                                                    <input id="cc-slug" value="{{$pAArr['sku']}}" required name="sku[]" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    >
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cc-slug" class="control-label mb-1"> Size</label>
                                                    <select name="size_id[]" id="size_id" class="form-control cc-name valid">
                                                        <option value="">Select Size</option>
                                                        @foreach ($size as $item)
                                                    @if($pAArr['size_id']==$item->id)
                                                        <option selected value="{{$item->id}}">{{$item->size}}</option>
                                                        @else
                                                        <option value="{{$item->id}}">{{$item->size}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cc-slug" class="control-label mb-1"> color</label>
                                                    <select name="color_id[]" id="color_id" class="form-control cc-name valid">
                                                        <option value="">Select Color</option>
                                                        @foreach ($color as $item)
                                                    @if($pAArr['color_id']==$item->id)
                                                    <option selected value="{{$item->id}}">{{$item->color}}</option>
                                                    @else
                                                    <option value="{{$item->id}}">{{$item->color}}</option>
                                                    @endif
                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="cc-slug" class="control-label mb-1"> Quantity</label>
                                                    <input id="cc-slug" value="{{$pAArr['qty']}}"  name="qty[]" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    >
                                                </div>
                                          
                                                
                                                <div class="col-md-3">
                                                    <label for="cc-slug" class="control-label mb-1"> Image</label>
                                                    <input  value={{$pAArr['attr_image']}} id="cc-slug"  name="attr_image[]" type="file" class="form-control cc-name valid" >
                        
                                                </div>
                                                <div class="col-md-3">
                                                    @if($pAArr['attr_image']!="")
                                                    <img width="150" src="{{asset('storage/media/'.$pAArr['attr_image'])}}" alt="">
                                                    @endif
                                                </div>
                                                @if($loop_count_num==2)
                                                <div>
                                                    <button onclick="add_more()"
                                                    id="payment-button" type="button" class="btn btn-lg btn-info btn-success m-t-30"><i class="fa fa-plus "></i>
                                                   Add attribute </button>
                                                </div>
                                                @else
                                              
                                                <div>
                                                <a href="{{url('admin/product/products_attr/delete/'.$pAArr['id']).'/'.$id}}">
                                                    <button onclick="remove({{$loop_count_prev}})"
                                                    id="payment-button" type="button" class="btn btn-lg btn-info btn-danger m-t-30"><i class="fa fa-minus "></i>
                                                   Remove attribute </button>    
                                                </a>    
                                                </div>
                                                @endif
                                            </div>
                                            
                                         
                                        </div>
                                       </div>
                                   </div>
                                   @endforeach
                               </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit
                                    </button>
                                </div>
                            </form>
                           
                        </div>
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