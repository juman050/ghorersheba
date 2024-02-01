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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Requested Services</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Service Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($request_services as $service)
                          <tr>
                            <td>{{ $service->req_user_name }}</td>
                            <td><a href="tel:{{ $service->req_user_phone }}">{{ $service->req_user_phone }}</a></td>
                            <td>{{ $service->req_service_name }}</td>
                            <td>
                            <a href="{{ url('/remove_service_requests',$service->req_service_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
