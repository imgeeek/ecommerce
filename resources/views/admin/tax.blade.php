@extends('admin.layout')
@section('page_title','tax')
@section('tax_select','active')
@section('content')
<div class="main-content">
 <h1>tax</h1>
 <a href="{{url('admin/tax/manage_tax')}}"><button type="button" class="btn btn-success">Add tax</button></a>

            <div class="row m-t-30">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tax description</th>
                                    <th>Tax Value</th>
                                    <th>ACTIONS</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item['tax_desc']}}</td>
                                    <td>{{$item['tax_value']}}</td>
                                   
                                    <td>
                                        {{-- 1 is active and 2 is deactive --}}
                                        @if($item->status==1)
                                        <a href="{{url('admin/tax/status/0/'.$item->id)}}"><button type="button" class="btn btn-info">Active</button></a>
@elseif($item->status==0)
<a href="{{url('admin/tax/status/1/'.$item->id)}}"><button type="button" class="btn btn-warning">Deactive</button></a>

@endif
                                        <a href="{{url('admin/tax/manage_tax/edit/'.$item->id)}}"><button type="button" class="btn btn-success">Edit</button></a>
                                        <a href="{{url('admin/tax/delete/'.$item->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
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