@extends('layouts.app')
@section('title')
| Services
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-success">
               <p>{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
           </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Services</div>
                <div class="panel-body">

                    
                        <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <!--<th>Price</th>-->
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                              <tr>
                                <td>{{ $service->service_id }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->service_slug }}</td>
                                <!--<td>৳{{ $service->service_price }}</td>-->
                                <td><a href="{{ url('/edit_service',$service->service_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> <a href="{{ url('/remove_service',$service->service_id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                              </tr>
                            @endforeach
                            </tbody>
                        </table>
                     
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add services <a href="{{ url('/services') }}" class="pull-right">Add New</a></div>
                    <div class="panel-body">
                    <?php 
                        $action = isset($get_service[0]->service_id) ? 'update_service':'add_service'
                    ?>
                    <form action="{{ url('/',$action) }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <div class="form-group">
                            <label for="service_name">Service Name:</label>
                            <input type="text" placeholder="Enter service Name" class="form-control" name="service_name" id="service_name" required="" value="{{ isset($get_service[0]->service_name) ? $get_service[0]->service_name:'' }}">
                            @if ($errors->has('service_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="service_slug">Service Sulg:</label>
                            <input type="text" placeholder="Enter service slug" class="form-control slug" name="service_slug" id="service_slug" required="" value="{{ isset($get_service[0]->service_slug) ? $get_service[0]->service_slug:'' }}">
                            @if ($errors->has('service_slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_slug') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group">
                            <label for="service_icon">Service icon:</label>
                            <input type="text" placeholder="fa fa-something" class="form-control" name="service_icon" id="service_icon" required="" value="{{ isset($get_service[0]->service_icon) ? $get_service[0]->service_icon:'' }}">
                            @if ($errors->has('service_icon'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_icon') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group">
                              <label for="sub_survice">Sub Service:</label>
                              <select multiple class="form-control multiple-select" id="service_sub_select" name="sub_services[]">
                                <?php 
                                foreach ($all_sub_service as  $sub_service) { 
                                    $slct="";
                                    if (isset($get_sub_service)) {
                                       foreach($get_sub_service as $g_sub):
                                        if($g_sub->sub_service_id===$sub_service->sub_service_id){
                                            $slct="selected";
                                        }
                                      endforeach;
                                    }
                                ?>
                                  <option value="<?php echo $sub_service->sub_service_id; ?>" <?php echo $slct;?>><?php echo $sub_service->sub_service_name; ?></option>
                                <?php } ?>
                              </select>
                              @if ($errors->has('sub_services'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sub_services') }}</strong>
                                </span>
                            @endif
                          </div>

                         <!--<div class="form-group">
                            <label for="service_price">Service price:</label>
                            <input type="text" placeholder="Enter service price" class="form-control" name="service_price" id="service_price" required="" value="{{ isset($get_service[0]->service_price) ? $get_service[0]->service_price:'' }}">
                            @if ($errors->has('service_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_price') }}</strong>
                                </span>
                            @endif
                          </div>-->

                          <div class="form-group">
                            <label for="service_img">Product Image</label>
                            <input type="file" id="service_img" name="service_img">
                            <p class="help-block">Image size should be less than 2MB.</p>
                            @if ($errors->has('service_img'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_img') }}</strong>
                                </span>
                            @endif
                            @if(isset($get_service[0]->service_img) && !empty($get_service[0]->service_img))
                            <img width="auto" height="50px" src="{{asset('images/'.$get_service[0]->service_img)}}">
                            
                            @endif
                        </div>

                          <div class="form-group">
                            <label for="service_short_desc">Service short description:</label>
                            <textarea placeholder="Enter Short description" class="form-control" name="service_short_desc" id="service_short_desc" required="">{{ isset($get_service[0]->service_short_desc) ? $get_service[0]->service_short_desc:'' }}</textarea>
                            
                            @if ($errors->has('service_short_desc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_short_desc') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group">
                            <label for="service_long_desc">Service long description:</label>
                            <textarea placeholder="Enter long description" class="form-control" name="service_long_desc" id="service_long_desc" required="" rows="5">{{ isset($get_service[0]->service_long_desc) ? $get_service[0]->service_long_desc:'' }}</textarea>
                            
                            @if ($errors->has('service_long_desc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service_long_desc') }}</strong>
                                </span>
                            @endif
                          </div>

                          <input type="hidden" name="service_id" value="{{ isset($get_service[0]->service_id) ? $get_service[0]->service_id : '' }}">
                          <button type="submit" class="btn btn-sm btn-success pull-right">{{ isset($get_service[0]->service_id) ? "Update":'Add' }}</button>
                        
                    </form>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.slug').slugify("#service_name");
         $('#service_sub_select').select2();
    });
</script>
@endpush
