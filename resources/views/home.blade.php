@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Orders</div>
                              <div class="card-body">{{ $orders }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Today</div>
                              <div class="card-body">৳ {{ $today }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">This Week</div>
                              <div class="card-body">৳ {{ $thisweek }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">This Month</div>
                              <div class="card-body">৳ {{ $thismonth }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Sales</div>
                              <div class="card-body">৳ {{ $orders_total }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Services</div>
                              <div class="card-body">{{ $services }}</div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Sub Services</div>
                              <div class="card-body">{{ $subservices }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Messages</div>
                              <div class="card-body">{{ $messages }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Total Cities</div>
                              <div class="card-body">{{ $cities }}</div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Call Requests</div>
                              <div class="card-body">{{ $request_calls }}</div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white">
                              <div class="card-header">Service Requests</div>
                              <div class="card-body">{{ $request_services }}</div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
