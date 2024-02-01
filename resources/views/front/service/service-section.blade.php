<section class="our-service-section">
    <div class="col-sm-12 text-center">
        <div class="service-header-div">
            <h1 class="service-header">Our <span>Services</span></h1>
        </div>
    </div>
    <div class="container">       
        <div class="service-section-blocks">
            <div class="row">
                <?php
                foreach ($serviceInfo as $services):?>
                <div class="service-block col-md-2 col-sm-3 col-xs-6">
                    <a href="{{ url('service',$services->service_slug) }}">
                        <div class="testy">
                            <i class="{{ $services->service_icon }}"></i>
                            <h4>{{ $services->service_name }}</h4>
                        </div>
                    </a>
                </div>
                <?php
                  endforeach;
                ?>
            </div>
        </div>
    </div>
</section>