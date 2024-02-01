@extends('layouts.app')
@section('title')
| Cities
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
                <div class="panel-heading">Cities</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                          <tr>
                            <td>{{ $city->city_id }}</td>
                            <td>{{ $city->city_name }}</td>
                            <td><a href="{{ url('/edit_city',$city->city_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> <a href="{{ url('/remove_city',$city->city_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add City <a href="{{ url('/cities') }}" class="pull-right">Add New</a></div>
                    <div class="panel-body">
                    <?php 
                            $action = isset($get_city[0]->city_id) ? 'update_city':'add_city'
                        ?>
                        <form action="{{ url('/',$action) }}" method="POST">
                            {{csrf_field()}}
                              <div class="form-group">
                                <label for="city_name">City Name:</label>
                                <input type="text" placeholder="Enter City Name" class="form-control" name="city_name" id="city_name" required="" value="{{ isset($get_city[0]->city_name) ? $get_city[0]->city_name:'' }}">
                                @if ($errors->has('city_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_name') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <input type="hidden" name="city_id" value="{{ isset($get_city[0]->city_id) ? $get_city[0]->city_id : '' }}">
                              <button type="submit" class="btn btn-sm btn-success pull-right">{{ isset($get_city[0]->city_id) ? "Update":'Add' }}</button>
                            
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
