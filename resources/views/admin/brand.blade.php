@extends('admin.layout')
@section('page_title','brand')
@section('brand_select','active')
@section('content')
<div class="main-content">
 <h1>brand</h1>
 <a href="{{url('admin/brand/manage_brand')}}"><button type="button" class="btn btn-success">Add brand</button></a>

            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Images</th>
                                    <th>ACTIONS</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item['name']}}</td>
                                   <td><img width="150" src="{{asset('storage/media/model').'/'.$item['image']}}" alt="ewf"></td>
                                    <td>
                                        {{-- 1 is active and 2 is deactive --}}
                                        @if($item->status==1)
                                        <a href="{{url('admin/brand/status/0/'.$item->id)}}"><button type="button" class="btn btn-info">Active</button></a>
@elseif($item->status==0)
<a href="{{url('admin/brand/status/1/'.$item->id)}}"><button type="button" class="btn btn-warning">Deactive</button></a>

@endif
                                        <a href="{{url('admin/brand/manage_brand/edit/'.$item->id)}}"><button type="button" class="btn btn-success">Edit</button></a>
                                        <a href="{{url('admin/brand/delete/'.$item->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </td>
                                  
                                </tr> 
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
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