@extends('layouts.app')
@section('title')
| Users
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
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered nowrap" style="width:100%" id="datatable">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                          <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><label class="label label-success">{{ $user->type }}</label></td>
                            <?php if (Auth::user()->type == 'super_admin'){?>
                                <td><a href="{{ url('/edit_user',$user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> 
                               <?php if ($user->type == 'admin'){?>
                            <a href="{{ url('/remove_user',$user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i> Delete</a></td> 
                        <?php }?>
                            <?php } else{?>
                                <td>No Permission.</td>
                            <?php }?>
                            
                            

                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add User <a href="{{ url('/users') }}" class="pull-right">Register User</a></div>
                    <div class="panel-body">

                        <?php 
                            $action = isset($get_user[0]->id) ? 'update_user':'craete_user'
                        ?>
                        <form class="form-horizontal" method="POST" action="{{ url($action) }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ isset($get_user[0]->id) ? $get_user[0]->id:'' }}" name="id">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  required autofocus value="{{ isset($get_user[0]->name) ? $get_user[0]->name:'' }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label" >User Type:</label>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type">
                                    <option value="admin" <?php if(isset($get_user[0]->type) && $get_user[0]->type=='admin') {echo "selected";}else {echo ''; }?>>Admin</option>
                                    <?php if(Auth::user()->type == 'super_admin') {?>
                                    <option value="super_admin" <?php if(isset($get_user[0]->type) && $get_user[0]->type=='super_admin') {echo "selected";}else {echo ''; }?>>Super Admin</option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ isset($get_user[0]->email) ? $get_user[0]->email:'' }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($get_user[0]->id) ? 'Update':'Register' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection