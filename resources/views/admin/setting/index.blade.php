@extends('layouts.app')
@section('title')
| Settings
@endsection
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
            <div class="alert alert-success">
               <p>{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
           </div>
            @endif
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Application Setting</div>
                <div class="panel-body">
                    <div role="tabpanel">
                        <div class="col-sm-3">
                            <ul class="nav nav-pills brand-pills nav-stacked" role="tablist">
                                <li role="presentation" class="brand-nav {{ isset($profile_active)?$profile_active:'' }}"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profile</a></li>
                                <li role="presentation" class="brand-nav {{ isset($about_active)?$about_active:'' }}"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><i class="fa fa-info"></i> About Us</a></li>
                                <li role="presentation" class="brand-nav {{ isset($social_active)?$social_active:'' }}"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><i class="fa fa-check-square"></i> Social Link</a></li>
                                <li role="presentation" class="brand-nav {{ isset($contact_active)?$contact_active:'' }}"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><i class="fa fa-phone"></i> Contact Us</a></li>
                                <li role="presentation" class="brand-nav {{ isset($maintanance_active)?$maintanance_active:'' }}"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab"><i class="fa fa-wrench"></i> Maintanance</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane {{ isset($profile_active)?$profile_active:'' }}" id="tab1">
                                    <form action="{{ url('/settings/update-profile') }}" method="POST">
                                        {{csrf_field()}}
                                          <div class="form-group">
                                            <label for="name">Full Name:</label>
                                            <input type="text" class="form-control" name="name" value="{{$currentuser->name}}" id="name">
                                          </div>
                                          <div class="form-group">
                                            <label for="email">Email address:</label>
                                            <input type="email" class="form-control" id="email" value="{{$currentuser->email}}" name="email">
                                          </div>
                                          <div class="form-group">
                                            <label for="pwd">Password:</label>
                                            <input type="password" class="form-control" id="pwd" name="password">
                                          </div>
                                          <input type="hidden" name="id" value="{{$currentuser->id}}">
                                          <button type="submit" class="btn btn-success">Submit</button>
                                        
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane {{ isset($about_active)?$about_active:'' }}" id="tab2">
                                    <form action="{{ url('/settings/about-us') }}" method="POST">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="">About Application:</label> 
                                        <textarea class="form-control" rows="7" placeholder="About us content ..." name="about_us" required="">{{isset($settings[0]->about_us)?$settings[0]->about_us:''}}
                                        </textarea>
                                      </div>
                                      <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane {{ isset($social_active)?$social_active:'' }}" id="tab3">
                                    <form action="{{ url('/settings/social-links') }}" method="POST">
                                      {{ csrf_field() }}
                                      

                                      <div class="form-group">
                                        <label for="fb_link">Facebook url:</label> 
                                        <input type="text" name="fb_link" placeholder="https://facebook.com/example" id="fb_link" class="form-control" value="{{isset($settings[0]->fb_link)?$settings[0]->fb_link:''}}">
                                        @if ($errors->has('fb_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fb_link') }}</strong>
                                            </span>
                                        @endif
                                      </div>

                                      <div class="form-group">
                                        <label for="tw_link">Twitter url:</label> 
                                        <input type="text" name="tw_link" placeholder="https://twitter.com/example" id="tw_link" class="form-control" value="{{isset($settings[0]->tw_link)?$settings[0]->tw_link:''}}">
                                        @if ($errors->has('tw_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tw_link') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                      <div class="form-group">
                                        <label for="ln_link">LinkedIn url:</label> 
                                        <input type="text" name="ln_link" placeholder="https://linkedin.com/in/example" id="ln_link" class="form-control" value="{{isset($settings[0]->ln_link)?$settings[0]->ln_link:''}}">
                                        @if ($errors->has('ln_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ln_link') }}</strong>
                                            </span>
                                        @endif
                                      </div>

                                      <div class="form-group">
                                        <label for="insta_link">Instagram url:</label> 
                                        <input type="text" name="insta_link" placeholder="https://instagram.com/example" id="insta_link" class="form-control" value="{{isset($settings[0]->insta_link)?$settings[0]->insta_link:''}}">
                                        @if ($errors->has('insta_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('insta_link') }}</strong>
                                            </span>
                                        @endif
                                      </div>

                                     <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane {{ isset($contact_active)?$contact_active:'' }}" id="tab4">
                                    <form action="{{ url('/settings/contact-info') }}" method="POST">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="email">Email:</label> 
                                        <input type="email" name="email" placeholder="Enter Email" id="email" class="form-control" value="{{isset($settings[0]->email)?$settings[0]->email:''}}" required="">
                                      </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                      <div class="form-group">
                                        <label for="address">Address:</label> 
                                        <textarea class="form-control" placeholder="Enter Address" name="address" required="">{{isset($settings[0]->address)?$settings[0]->address:''}}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                      </div>

                                      <!--
                                       <div class="form-group">
                                       <label for="hour_of_operation">Hour Of Operation:</label> 
                                        <textarea class="form-control" placeholder="Write operation time" name="hour_of_operation" type="hidden">{{isset($settings[0]->hour_of_operation)?$settings[0]->hour_of_operation:''}}</textarea>
                                      </div>
                                     -->

                                      <div class="form-group">
                                        <label for="hour_of_operation">Whatsapp Number:</label> 
                                        <input type="text" name="whatsapp_number" placeholder="Whatsapp number" id="whatsapp_number" class="form-control" value="{{isset($settings[0]->whatsapp_number)?$settings[0]->whatsapp_number:''}}" required="">
                                      </div>

                                      <div class="form-group">
                                        <label for="phone_number">Phone Number:</label> 
                                        <input type="text" name="phone_number" placeholder="Phone number" id="phone_number" class="form-control" value="{{isset($settings[0]->phone_number)?$settings[0]->phone_number:''}}" required="">
                                        @if ($errors->has('phone_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                       <!--
                                      <div class="help-text">Enter coordinates to find a place</div>
                                      <div class="form-group">
                                        <label for="map_lat">Latitude:</label> 
                                        <input type="text" name="map_lat" placeholder="Enter latitude" id="map_lat" class="form-control" value="{{isset($settings[0]->map_lat)?$settings[0]->map_lat:''}}">
                                      </div>
                                      <div class="form-group">
                                        <label for="map_long">Longitude :</label> 
                                        <input type="text" name="map_long" placeholder="Enter longitude" id="map_long" class="form-control" value="{{isset($settings[0]->email)?$settings[0]->map_long:''}}">

                                      </div>
                                      -->
                                     <button type="submit" class="btn btn-success">Update</button>
                                    </form>

                                </div>

                                <div role="tabpane5" class="tab-pane {{ isset($maintanance_active)?$maintanance_active:'' }}" id="tab5">
                                    <form action="{{ url('/settings/maintanance') }}" method="POST">
                                      {{ csrf_field() }}
                                       <div class="form-group">
                                        Maintanance mode: 
                                        <label class=" <?php if($settings[0]->maintanance_mode == '1') echo "active";?>"> 
                                          <input type="checkbox" class="btn btn-success" autocomplete="off" name="maintanance_mode" <?php if($settings[0]->maintanance_mode == '1') echo "checked";?>>
                                        </label>
                                       </div>
                                      <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    function openCity(evt, cityName) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the link that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>
@endpush