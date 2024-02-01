@extends('front.master')
@section('title')
    Contact-Us
@endsection
@section('mainContent')
<div class="hero-image" style='background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("{{ url("public/front/img/banner-01.jpg")}}");'>
    <div class="hero-text">
        <h1 style="font-size:35px;font-weight: 700;">Contact Us</h1>
    </div>
</div>
<section class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
            <div class="single-box">
                <h1 class="service-header">SEND US MESSAGE</h1>
                <form name="contactForm" id="contactForm" method="post" action="{{url('/send-message')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                            <div class="alert alert-success">
                               <p>{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                           </div>
                            @endif
                        </div>  
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">First Name</label><br>
                                <input type="text" name="fname" value="" class="form-control"  placeholder="Enter First Name" id="fname" required="">
                            </div>
                            @if ($errors->has('fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Last Name</label><br>
                                <input type="text" name="lname" value=""  class="form-control" placeholder="Enter Last Name" id="lname" required="">
                            </div>
                            @if ($errors->has('lname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email address</label><br>
                                <input type="email" name="email" id="email" value="" class="form-control"  placeholder="Enter Your Email" required="">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Phone</label><br>
                                <input type="number" name="phone_number" id="pnone" value="" class="form-control"  placeholder="Enter Your Phone Number" required="" minlength="9" maxlength="14" >
                            </div>
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Message</label><br>
                                 <textarea name="message" cols="40" rows="7" class="form-control"  placeholder="Write Message..." id="message" required=""></textarea>
                            </div>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                     </div>
                    
                    
                    <button type="submit" class="btn btn-default btn-rounded">Submit</button>
                  </form>
            </div>
            
        </div>
        <div class="col-md-4 col-md-offset-1">
            <div class="single-box">
                <h1 class="service-header">OUR ADDRESS</h1>
                <p><span>Phone : </span><?php echo $settings[0]->phone_number; ?></p>
                <p><span>Email : </span><?php echo $settings[0]->email;  ?></p>
                <p><span>ADDRESS : </span><?php echo $settings[0]->address;  ?></p>
                <ul class="about-social-icon" style="margin-left: 0px;">
                    <li><a class="fb" target="_blank" href="{{ $settings[0]->fb_link }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="tw" target="_blank" href="{{ $settings[0]->tw_link }}"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="li" target="_blank" href="{{ $settings[0]->ln_link }}"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="gp" target="_blank" href="{{ $settings[0]->insta_link }}"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</section>
@include('front.service.service-section')
@endsection
@push('scripts')
<script type="text/javascript">
    (function($){
          "use strict";
          /**
            * ----------------------------------------------
            *  Choose your Service
            * ----------------------------------------------
          */
            

          var form=$("#contactForm");
                form.validate({
                    rules: {
                       
                       fname: {
                        required: true
                       },
                       lanme: {
                         required: true
                       },
                       email: {
                             required: true,
                             email: true
                        },
                        message: {
                          required: true
                        },
                        phone: {
                          required: true
                        }
                   },
                   messages: {
                           fname: "Enter First Name",
                           lname: "Enter Last Name.",
                           email: {
                               required: "Enter Email.",
                               email: "This is not a valid email!"
                           },
                           message: "Enter Message.",
                           phone:{
                               required:"Enter Phone Number.",
                               phone: "This is not a valid number!"
                           } 

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
    })(jQuery);
</script>
@endpush