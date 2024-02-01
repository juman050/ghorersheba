@extends('front.master')
@section('title')
    About-Us
@endsection
@section('mainContent')
<div class="hero-image" style='background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("{{ url("public/front/img/banner-01.jpg")}}");'>
    <div class="hero-text">
        <h1 style="font-size:35px;font-weight: 700;">About Us</h1>
    </div>
</div>
<section class="about-us">
    <div class="container">
        <div class="row single-box">
            <h1 class="service-header">About Us</h1>
            
            <div>{!! $settings[0]->about_us !!}</div>
            <div class="about-social">Be social with GhorerSheba : </div>
            <ul class="about-social-icon">
                            <li><a class="fb" target="_blank" href="{{ $settings[0]->fb_link }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="tw" target="_blank" href="{{ $settings[0]->tw_link }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="li" target="_blank" href="{{ $settings[0]->ln_link }}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="gp" target="_blank" href="{{ $settings[0]->insta_link }}"><i class="fa fa-instagram"></i></a></li>
                        </ul>
        </div>
    </div>
</section>
 @include('front.service.service-section')
@endsection