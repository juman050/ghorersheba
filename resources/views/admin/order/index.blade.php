@extends('layouts.app')
@section('title')
| orders
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
                <div class="panel-heading">orders</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        {{csrf_field()}}
                        <thead>
                          <tr>
                            <th>OrderId</th>
                            <th>Service</th>
                            <th>Sub Services</th>
                            <th>Order Total</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ service($order->id) }}</td>
                            <td>{!! subService($order->id) !!}</td>
                            <td class="order-total-row{{ $order->id }}">

                                ৳ <span class="get_total{{ $order->id }}">{{ number_format((float)$order->order_total, 2, '.', '') }}</span>
                                <input type="button" class="edit_button{{ $order->id }}" value="Edit" class="edit" onclick="edit_row('{{ $order->id }}')">
                                <input type="button" class="save_button{{ $order->id }}" value="Save" class="save" onclick="save_row('{{ $order->id }}')" style="display:none">
                            </td>
                            <td>{{ date('d-M-Y H:i a', strtotime($order->created_at)) }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{ $order->customer_phone_number }}</td>
                            <td>{!! orderStatus($order->order_status) !!}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle" aria-expanded="false" title="Order Action"><i class="fa fa-caret-down"></i></button>
                                    <ul class="dropdown-menu">
                                        @if($order->order_status !='1')
                                        <li><a href="{{url('complete_order/'.$order->id)}}">Proceed</a></li>
                                        @endif
                                        @if($order->order_status !='2')
                                        <li><a href="{{url('cancel_order/'.$order->id)}}" class="font-bold">Cancel</a></li>
                                        @endif
                                        <li><a href="{{url('remove_order/'.$order->id)}}" class="font-bold">Delete</a></li>
                                        
                                    </ul>
                                </div>
                            </td>
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
@push('scripts')
<script type="text/javascript">
    function edit_row(id)
    {
        $(".edit_button"+id).hide();
        $(".save_button"+id).show();
        var order_val=$(".get_total"+id).text();
        $(".get_total"+id).html("<input type='text' class='input-total"+id+"' style='width: 60px;' value='"+order_val+"'>");
       // alert(id)



    }

    function save_row(id)
    {
        var _token = $('input[name="_token"]').val();
        var order_val=$(".input-total"+id).val();
        
        if(isPositiveInteger(order_val)){
            $(".save_button"+id).hide();
            $.ajax({
              type:'post',
              url:'{{ url("/order/update") }}',
              data:{
                _token:_token,
               order_id:id,
               order_total:order_val
              },
              success:function(response) {
                $(".get_total"+id).text(order_val);
                $(".edit_button"+id).show();
              }
            });
        }else{
            alert('invalid value.')
        }
     
    }

    function isPositiveInteger(n) {
        return parseFloat(n) === n >>> 0;
    }

</script>
@endpush