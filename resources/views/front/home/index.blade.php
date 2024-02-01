@extends('front.master')
@section('title')
    HOME
@endsection
@section('mainContent')
<section class="banner-wrap">
    <div class="front-banner" style='background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("{{ url("public/front/img/banner-01.jpg")}}");background-position: center center;background-size: cover;background-repeat: no-repeat;height: 300px'>
        <div class="container">
            <div class="form-box">
                <form id="service-form" action="{{ url('/service') }}" method="post" >
                    {{ csrf_field() }}
                    <h3 class="title heading-3" style="color:#fff;">Choose your service</h3>
                    <div class="input-group col-md-6 col-md-offset-3">
                        <select class="form-control" id="service" name="service" required="">
                            <option value="">Select service</option>
                            <?php
                            foreach ($serviceInfo as $service):?>
                                <option value="<?php echo $service->service_id;?>"><?php echo $service->service_name;?></option>                    
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">Book Now</button>
                        </span>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@include('front.service.service-section')
@endsection