@extends('front.master')
@section('title')
    How it works
@endsection
@section('mainContent')
<div class="hero-image" style='background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("{{ url("public/front/img/banner-01.jpg")}}");'>
    <div class="hero-text">
        <h1 style="font-size:35px;font-weight: 700;">How it works</h1>
    </div>
</div>
<section class="how">
    <div class="container">
            <div class="row single-box">
                <div class="col-md-6 text-center">
                    <img class="img-responsive center" src="{{url('public/front/img/step-1.png')}}">
                </div>
                <div class="col-md-6">
                    <div class="how-it-works-process">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom:30px;">
                                <div class="startern-header-div">
                                    <h3 class="title heading-3 hr">Tell us <span>what to do</span></h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>Booking any service with ghorersheba is a few clicks' job. Select a service, select your location, give your contact and done! If you want to do it even faster, just call to {{ $settings[0]->phone_number }} and tell how can we help.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row single-box">
                <div class="col-md-6">
                    <div class="how-it-works-process">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom:30px;">
                                <div class="startern-header-div">
                                     <h3 class="title heading-3 hr">Confirm &amp; <span>Agree</span></h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>Once you are done with booking a service, our customer manager instantly calls you and asks a few questions to collect more details about the job. Upon your consent, he confirms and schedules your service accordingly.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center" align="center">
                    <img class="img-responsive center" src="{{url('public/front/img/step-2.png')}}">
                </div>
            </div>
            <div class="row single-box">
                <div class="col-md-6 text-center">
                    <img class="img-responsive center" src="{{url('public/front/img/step-3.png')}}">
                </div>
                <div class="col-md-6">
                    <div class="how-it-works-process">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom:30px;">
                                <div class="startern-header-div">
                                    <h3 class="title heading-3 hr"><span>Relax</span></h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>What next? Nothing! Now, you relax. Or you can focus on your most important and high-value tasks while we take care of your everything else.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row single-box">
                <h3 class="title heading-3 hr text-center">Payment <span>Methods</span></h3>
                <br>
                        <div class="col-sm-12">
                            <p>Currently we take only Cash on Service Delivery. Once your task is done with one hundred percent satisfaction, you pay the bill which&nbsp;is sent to you via Email or SMS. Our Handyman or one of our Operation Executive receives the payment with a Money Receipt and Feedback Form.

Please do not negotiate with the tasker for any kind of monetary incentive. Or please report back to our Customer Manager if any tasker asks for tip or extra charge. </p>
                        </div>
                        <div class="col-sm-6 payment-method-p">
                            <h4>Current Methods :</h4>
                            <img src="{{url('public/front/img/bank-0.png')}}">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-6 payment-method-p">
                            <h4>Coming Soon :</h4>
                            <img src="{{url('public/front/img/bank.png')}}">
                            <div class="clearfix"></div>
                        </div> 
                    </div>
        </div>
</section>
 @include('front.service.service-section')
@endsection