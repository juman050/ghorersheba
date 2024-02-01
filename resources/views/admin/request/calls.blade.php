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
                <div class="panel-heading">Requested Calls</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($get_calls as $call)
                          <tr>
                            <td>{{ $call->req_name }}</td>                            
                            <td><a href="tel:{{ $call->req_number }}">{{ $call->req_number }}</a></td>
                            <td>{{ date('d-M-Y H:i a', strtotime($call->created_at)) }}</td>
                            <td>
                            <a href="{{ url('/remove_call_requests',$call->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
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
