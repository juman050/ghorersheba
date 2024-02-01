<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ghorer-Sheba | @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('public/front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/front/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/front/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/front/css/style.css') }}">
        
        
    </head>
    <body>
        <!-- header -->
        @include('front.includes.header')
        
        <!-- maincontent -->
        @yield('mainContent')
       
        <!-- footer -->
        @include('front.includes.footer')

        <!-- jQuery v3.1.1 -->
        <script src="{{ asset('public/front/js/jquery.min.js') }}"></script>
        <!-- Bootstrap v3.3.7 -->
        <script src="{{ asset('public/front/js/bootstrap.min.js') }}"></script>
        <!--=== validate js ===-->
        <script type="text/javascript" src="{{ asset('public/front/js/jquery.validate.min.js') }}"></script>
        <!--=== custom js ===-->
        <script src="{{ asset('public/front/js/bootstrap-select.min.js') }}"></script>
        <!--=== custom js ===-->
        <script src="{{ asset('public/front/js/custom.js') }}"></script>
        @stack('scripts');
        <!--=== service js ===-->
        <script type="text/javascript">
          // ===== Scroll to Top ==== 
          $(window).scroll(function() {
              if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                  $('#return-to-top').fadeIn(200);    // Fade in the arrow
              } else {
                  $('#return-to-top').fadeOut(200);   // Else fade out the arrow
              }
          });
          $('#return-to-top').click(function() {      // When arrow is clicked
              $('body,html').animate({
                  scrollTop : 0                       // Scroll to top of body
              }, 500);
          });
   
      </script>
        
      <script>
        $(document).ready(function() {
          $('.selectpicker').selectpicker();          
        });
      </script>

      <script type="text/javascript">
         var site_url = "{{ url('/') }}";

        (function($){
          "use strict";
          /**
            * ----------------------------------------------
            *  Choose your Service
            * ----------------------------------------------
          */
            

          var form=$("#request-call-form");
                form.validate({
                    rules: {
                       
                       customer_name: {
                         required: true
                       },
                        phone_number: {
                          required: true,
                          minlength:11, 
                          maxlength:14
                        }
                   },
                   messages: {
                           customer_name: "Enter your name.",
                           phone_number: "Enter  your phone number."

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
          $(".request-send").click(function(e){
              e.preventDefault();
              e.stopPropagation();
              var form=$("#request-call-form");
              if (form.valid()) {
                var _token = $('input[name="_token"]').val();
                var customer_name = $('input#customer_name').val();
                var phone_number = $('input#phone_number').val();
                $.ajax({
                  url: '{{ url("/request-call") }}',
                  type: 'POST',
                  data: {_token: _token, customer_name: customer_name,phone_number:phone_number},
                  success: function (response) {
                    form[0].reset();
                    alert('Our Team will Contact you soon!')
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
    </body>
</html>
