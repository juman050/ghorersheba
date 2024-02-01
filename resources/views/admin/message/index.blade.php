@extends('layouts.app')
@section('title')
| messages
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
                <div class="panel-heading">Messages</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th width="1%">Id</th>
                            <th width="10%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Phone</th>
                            <th width="25%">Message</th>
                            <th width="10%">Status</th>
                            <th width="15%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                          <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->fname }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->phone_number }}</td>
                            <td>{{ $message->message }}</td>
                            <td><span class="<?php if($message->status == '0'){echo 'label label-warning">pending';}else{echo 'label label-success">replied';} ?></span></td>
                            <td><a href="#" class="btn btn-sm btn-primary send-msg" data-id="{{ $message->id }}" data-email="{{ $message->email }}" data-fname="{{ $message->fname }}"><i class="fa fa-back"></i> Reply</a> <a href="{{ url('/remove_message',$message->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="message" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body">
          <form id="msg-form" action="#">
            {{csrf_field()}}
              <p class="to"></p>
              <input type="hidden" id="email">
              <input type="hidden" id="fname">
              <input type="hidden" id="msg-id">
              <textarea class="form-control" placeholder="Write message here..." id="message-text" required=""></textarea>
              <br>
              <input type="button" class="btn btn-sm btn-success" id="send" value="Send">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--End Modal -->
@endsection

@push('scripts')
<script type="text/javascript">
    jQuery(function($){
        var form = $("form#msg-form");
        $(document).on('click','.send-msg',function(e){
            /* Act on the event */
            e.preventDefault();
            var email = $(this).data('email');
            var fname = $(this).data('fname');
            var id = $(this).data('id');
            $('#fname').val(fname);
            $('#email').val(email);
            $('#msg-id').val(id);
            $('.to').html("To: "+email)
            $("#message").modal('show');
        }); 

        $(document).on('click','#send',function(e){
            /* Act on the event */
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            var email = $('#email').val();
            var msg_id = $('#msg-id').val();
            var fname = $('#fname').val();
            var message = $('#message-text').val();
            if (message != "") {
            $("#message").modal('hide');
                $.ajax({
                    url: '{{ url("/reply-msg") }}',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        _token:_token, 
                        email: email, 
                        fname:fname, 
                        message:message, 
                        id:msg_id
                    },
                })
                .done(function() {
                    //alert("message has been sent successfully.");
                    form[0].reset();
                    location.reload();
                })
                .fail(function(response) {
                    console.log("error");
                    alert("error.");
                    
                })
            }else{
                alert("Message field required.");
            }
            
            
        });
    });
</script>
@endpush