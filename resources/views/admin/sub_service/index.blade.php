@extends('layouts.app')
@section('title')
| sub services
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-success">
               <p>{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
           </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Sub services</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($sub_services as $sub_service)
                          <tr>
                            <td>{{ $sub_service->sub_service_id }}</td>
                            <td>{{ $sub_service->sub_service_name }}</td>
                            <td>৳ {{ number_format((float)$sub_service->sub_service_price, 2, '.', '') }}</td>
                            <td><a href="{{ url('/edit_sub_service',$sub_service->sub_service_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> <a href="{{ url('/remove_sub_service',$sub_service->sub_service_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add sub service <a href="{{ url('/sub_services') }}" class="pull-right">Add New</a></div>
                    <div class="panel-body">
                    <?php 
                            $action = isset($get_sub_service[0]->sub_service_id) ? 'update_sub_service':'add_sub_service'
                        ?>
                        <form action="{{ url('/',$action) }}" method="POST">
                            {{csrf_field()}}
                              <div class="form-group">
                                <label for="sub_service_name">Sub service Name:</label>
                                <input type="text" placeholder="Enter Sub service Name" class="form-control" name="sub_service_name" id="sub_service_name" required="" value="{{ isset($get_sub_service[0]->sub_service_name) ? $get_sub_service[0]->sub_service_name:'' }}">
                                @if ($errors->has('sub_service_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_service_name') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="sub_service_price">Sub Service price:</label>
                                <input type="text" placeholder="Enter sub service price" class="form-control" name="sub_service_price" id="sub_service_price" required="" value="{{ isset($get_sub_service[0]->sub_service_price) ? $get_sub_service[0]->sub_service_price:'' }}">
                                @if ($errors->has('sub_service_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_service_price') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <input type="hidden" name="sub_service_id" value="{{ isset($get_sub_service[0]->sub_service_id) ? $get_sub_service[0]->sub_service_id : '' }}">
                              <button type="submit" class="btn btn-sm btn-success pull-right">{{ isset($get_sub_service[0]->sub_service_id) ? "Update":'Add' }}</button>
                            
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
