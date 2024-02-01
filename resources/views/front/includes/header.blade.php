<div class="main-wrap">
  <nav class="navbar navbar-default navbar-fixed">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>    
      <a class="navbar-brand" href="{{ url('/') }}">Ghorer-Sheba</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="<?php if(isset($active) && $active=='home')echo 'active'; ?>" ><a href="{{ url('/') }}">Home</a></li>
        <li class="dropdown <?php if(isset($active) && $active=='service')echo 'active'; ?>">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Services
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($serviceInfo as $service):?>
                <li><a href="{{ url('/service',$service->service_slug) }}"><?php echo $service->service_name;?></a></li>
            <?php
              endforeach;
            ?>
          </ul>
        </li>
        <li class="<?php if(isset($active) && $active=='howitworks')echo 'active'; ?>"><a href="{{ url('/how-it-works') }}">How it works</a></li>
        <li class="<?php if(isset($active) && $active=='about')echo 'active'; ?>"><a href="{{ url('/about') }}">About</a></li>
        <li class="<?php if(isset($active) && $active=='contact')echo 'active'; ?>"><a href="{{ url('/contact') }}">Contact Us</a></li>
        <li><a href="https://api.whatsapp.com/send?phone=<?php echo $settings[0]->whatsapp_number;?>"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
        <li><a href="tel:<?php echo $settings[0]->phone_number;?>"><i class="fa fa-phone"></i> Call: <?php echo $settings[0]->phone_number;?></a></li>
        <li><a href="#" class="btn btn-sm btn-success request-call" data-toggle="modal" data-target="#callrequest">Request a call</a></li>
        <li><a href="{{ url('/request-service') }}" class="btn btn-sm btn-success request-call">Request a service</a></li>
      </ul>

    </div>
  </nav>
<!-- Modal -->
<div id="callrequest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request a call</h4>
      </div>
      <div class="modal-body">
        <form id="request-call-form">
          {{csrf_field()}}
           <div class="form-group">
             <label for="customer_name">Your Name:</label>
              <input type="text" placeholder="Enter Your Name" class="form-control" name="customer_name" id="customer_name" required="">
           </div>
           <div class="form-group">
             <label for="phone_number">Your Number:</label>
              <input type="number" placeholder="Enter Your Phone Number" class="form-control" name="phone_number" id="phone_number" required="">
           </div>
           <input type="submit" class="btn btn-success request-send" value="Call Request">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>