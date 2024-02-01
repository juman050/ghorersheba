@extends('front.master')
@section('title')
    HOME
@endsection
@section('mainContent')
<div class="hero-image" style='background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("{{ url("public/front/img/banner-01.jpg")}}");'>
    <div class="hero-text">
        <h1 style="font-size:35px;font-weight: 700;">{{ $serviceSingle[0]->service_name }}</h1>
    </div>
</div>
<div class="container" id="mydivs">
    <div class="row">
      <div class="col-md-7 col-sm-6">
        <div class="single-box">
          <h3 class="title heading-3 hr"><span>{{ $serviceSingle[0]->service_name }}</span> Services</h3>
          <?php 
            if(!empty($serviceSingle[0]->service_img))
            { 
              $src = 'images/'.$serviceSingle[0]->service_img; 
            }else{
              $src = 'public/front/img/services.png';
            } 
          ?>
          <img src="{{ url($src) }}" height="200px" width="auto">
          <br>
          <br>
          <p>{{ $serviceSingle[0]->service_long_desc }} </p>
          <!--<p><b>price start from {{ $serviceSingle[0]->service_price }} tk.</b></p>-->
          
          <h4>Sub services</h4>
            <?php
            foreach ($sub_survices as $sub_survice):?>
             <span class="label label-success"><?php echo $sub_survice->sub_service_name;?> (৳ <?php echo $sub_survice->sub_service_price;?> )</span>
            <?php endforeach;?>

          <br>
          <br>
          <a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=example.org" target="_blank">
            <i class="fa fa-facebook"></i> Share
          </a>

        </div>
      </div>
      <div class="col-md-5 col-sm-6">
        <div class="form-box">
          <form id="order-form" action="#" method="post" >
              {{ csrf_field() }}
              <fieldset>
                  <h3 class="title heading-3">Order Form</h3>
                  
                  <input type="hidden" name="service_id" id="service_id" value="{{ $serviceSingle[0]->service_id }}">
                  <input type="hidden" name="service_price" id="service_price" value="{{ $serviceSingle[0]->service_price }}">
                  <div class="subservice">
                      <select multiple class="form-control required selectpicker" id="subservice" name="subservice[]" required="" data-selected-text-format="count" data-actions-box="true" data-live-search="true" title="Select Sub Service">
                        <?php
                        foreach ($sub_survices as $sub_survice):?>
                         <option value="<?php echo $sub_survice->sub_service_id;?>"><?php echo $sub_survice->sub_service_name;?> (৳ <?php echo $sub_survice->sub_service_price;?> )</option>                    
                        <?php
                        endforeach;
                        ?>
                      </select>
                  </div>
                  <div class="select-group">
                    <select  class="form-control required" id="city" name="city" required="">
                      <option value="">Select City</option>
                        <?php
                        foreach ($cities as $city):?>
                         <option value="<?php echo $city->city_name;?>"><?php echo $city->city_name;?></option>                    
                        <?php
                        endforeach;
                        ?>
                      </select>
                  </div>
                  <div class="inputGroup">
                      <input type="text" id="area" placeholder="Your area" name="area">
                  </div>
                  <div class="inputGroup">
                      <textarea placeholder="Your adress" id="address" name="address"></textarea>
                  </div>
                  <div class="buttonGroup">
                      <button class="btn-rounded hidden">Prev</button>
                      <button class="btn-rounded next">Next</button>
                      <button class="btn-rounded hidden">Send</button>
                  </div>
              </fieldset>
              <fieldset>
                  <h3 class="title heading-3">Type your details</h3>
                    <div class="alert alert-success" style="display: none;margin-left: 20px;
    margin-right: 20px;">
                     <p> Congratulations!<br>
A big THANK YOU for confirming your service order! One of our Customer Manager will call you in few minutes. This is the first step of being an awesome GhorerSheba customer. You're more than important to us. And we love you. Enjoy our service! <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    </div>
                  <div class="inputGroup">
                      <input type="text" placeholder="Your name" id="name" name="name">
                  </div>
                  <div class="inputGroup">
                      <input type="email" placeholder="Your email" id="email" name="email" value="">
                  </div>
                  <div class="inputGroup">
                      <input type="number" placeholder="Your phone no" id="phone" name="phone">
                  </div>
                  <div class="buttonGroup">
                      <button class="btn-rounded prev">Prev</button>
                      <button class="btn-rounded order">Send</button>
                  </div>
              </fieldset>
          </form>
      </div>
      </div>
    </div>
</div> 
@include('front.service.service-section')
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
            

          var form=$("#order-form");
                form.validate({
                    rules: {
                       
                       "subservice[]": {
                        required: true
                       },
                       name: {
                         required: true
                       },
                       area: {
                         required: true
                       },
                       city: {
                         required: true
                       },
                       email: {
                             required: true,
                             email: true
                        },
                        address: {
                          required: true
                        },
                        phone: {
                          required: true,
                          minlength:11, 
                          maxlength:14
                        }
                   },
                   messages: {
                           "subservice[]": "Please select some sub service.",
                           name: "Enter your name.",
                           city: "Enter your city.",
                           area: "Enter your area.",
                           email: {
                               required: "Enter your email.",
                               email: "This is not a valid email!"
                           },
                           address: "Enter your address.",
                           phone: "Enter  your phone number."

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
          //showing first div
          $("#order-form fieldset").each(function(e) {
            if (e != 0)
              $(this).hide();
          });

          //next div
          $(".next").click(function(e){ 
            e.preventDefault();
            var options = $('#subservice > option:selected');
            if(options.length == 0){
              alert('Select at least one service.')
              return false;
            }

            if (form.valid()) {
              // just for the demos, avoids form submit
              if ($("#order-form fieldset:visible").next().length != 0)
                $("#order-form fieldset:visible").next().show().prev().hide();        
              else {
                $("#order-form fieldset:visible").hide();
                $("#order-form fieldset:first").show();
              }
            }
            
          });

          //preveous div
          $(".prev").click(function(e){
            e.preventDefault();
              if ($("#order-form fieldset:visible").prev().length != 0)
                $("#order-form fieldset:visible").prev().show().next().hide();
              else {
                $("#order-form fieldset:visible").hide();
                $("#order-form fieldset:last").show();
              }
          });

          //making order
          $(".order").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var form=$("#order-form");
            if (form.valid()) {
              var _token = $('input[name="_token"]').val();
              var service_id = $('input#service_id').val();
              var service_price = $('input#service_price').val();
              var subservices = $('select#subservice').val();
              var customer_city = $('select#city').val();
              var customer_area = $('input#area').val();
              var customer_address = $('textarea#address').val();
              var customer_name = $('input#name').val();
              var customer_email = $('input#email').val();
              var customer_phone_number = $('input#phone').val();
              $.ajax({
                url: '{{ url("/make-order") }}',
                type: 'POST',
                data: {_token: _token, service_id: service_id,subservices:subservices,service_price:service_price,customer_city:customer_city, customer_area:customer_area, customer_address:customer_address, customer_name:customer_name, customer_email:customer_email, customer_phone_number:customer_phone_number},
                success: function (response) {
                  $('.alert.alert-success').css('display','block');
                  form[0].reset();
                  setTimeout(function() {
                    location.reload();
                   //window.location.href = site_url;
                  }, 5000);
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