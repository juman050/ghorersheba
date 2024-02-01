@extends('front.master')
@section('title')
    service request
@endsection
@section('mainContent')
<section class="about-us">
    <div class="container">
        <div class="row single-box">
            
            <div class="col-md-6">
              <h1 class="service-header">Service Request Form</h1>
              <form id="request-service">
                {{csrf_field()}}
                 <div class="form-group">
                   <label for="req_user_name">Your Name:</label>
                    <input type="text" placeholder="Enter Name" class="form-control" name="req_user_name" id="req_user_name" required="">
                 </div>
                 <div class="form-group">
                   <label for="req_user_phone">Your Number:</label>
                    <input type="number" placeholder="Enter Phone Number" class="form-control" name="req_user_phone" id="req_user_phone" required="">
                 </div>
                 <div class="form-group">
                   <label for="req_service_name">Service Name:</label>
                    <input type="text" placeholder="Enter Service Name" class="form-control" name="req_service_name" id="req_service_name" required="">
                 </div>
                 <div class="form-group">
                   <label for="req_service_description">Service Description:</label>
                    <textarea class="form-control" placeholder="Enter Service Description"  name="req_service_description" id="req_service_description" required=""></textarea>
                 </div>
                 <input type="submit" class="btn btn-success request-service" value="Service Request">
              </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
  var site_url = "{{ url('/') }}";

        (function($){
          "use strict";
          /**
            * ----------------------------------------------
            *  Choose your Service
            * ----------------------------------------------
          */
            

          var form=$("#request-service");
                form.validate({
                    rules: {
                       req_user_name: {
                         required: true
                       },
                        req_service_name: {
                          required: true
                        },
                        req_service_description: {
                          required: true
                        },
                        req_user_phone: {
                          required: true,
                          minlength:11, 
                          maxlength:14
                        }
                   },
                   messages: {
                           req_user_name: "Enter your name.",
                           req_service_name: "Enter Service Name.",
                           req_service_description: "Enter Service Description.",
                           req_user_phone: "Enter  your phone number."

                    },
                    highlight: function(label) {
                $(label).closest('.control-group').addClass('error');
              },
                  submitHandler: function(form) {
                    // some other code
                    // maybe disabling submit button
                    // then:
                    form.submit();
                  }
          });
      

          //making order
          $(".request-service").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var form=$("#request-service");
            if (form.valid()) {
              var _token = $('input[name="_token"]').val();
              var req_user_name = $('input#req_user_name').val();
              var req_user_phone = $('input#req_user_phone').val();
              var req_service_name = $('input#req_service_name').val();
              var req_service_description = $('textarea#req_service_description').val();
              $.ajax({
                url: '{{ url("/make-service-request") }}',
                type: 'POST',
                data: {_token: _token, req_user_name: req_user_name,req_user_phone:req_user_phone,req_service_name:req_service_name,req_service_description:req_service_description},
                success: function (response) {
                  form[0].reset();
                  alert('Thank you for the request!')
                  window.location.href = site_url;
                },
                error: function (response) {
                  console.log(response.responseText)
                  var response = eval("(" + response.responseText + ")");
                  alert(response.message);
                }
              });
              
            }
          });        


        })(jQuery);

        
</script>
@endpush