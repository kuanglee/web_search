@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> {{trans('action.user.user_edit')}}
                        <small></small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <?= Form::open(['url' => '/admin/users/update/' . $id, "id" => "frmValidate", "enctype" => "multipart/form-data"]); ?>
                    @csrf()
                    @method('PATCH')
                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.user.name')}}</label>
                        <input type="text" name="name" class="form-control" required
                               value="{!! old('name' ,isset($users) ? $users->name : null) !!}"
                               placeholder="{{trans('action.user.placeholder.name')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('name')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.user.email')}}</label>
                        <input type="email" name="email" class="form-control" required
                               value="{!! old('email' ,isset($users) ? $users->email : null) !!}"
                               placeholder="{{trans('action.user.placeholder.email')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('name')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.user.address')}}</label>
                        <input type="text" name="address" class="form-control" required
                               value="{!! old('email' ,isset($users) ? $users->address : null) !!}"
                               placeholder="{{trans('action.user.placeholder.adress')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('adress')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.user.password')}}</label>
                        <input type="password" name="password" class="form-control" required
                               value="{!! old('password') !!}"
                               placeholder="{{trans('action.user.placeholder.password')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('password')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.user.confirm_password')}}</label>
                        <input type="password" name="confirm_password" class="form-control" required
                               value="{!! old('password') !!}"
                               placeholder="{{trans('action.user.placeholder.confirm_password')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('confirm_password')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputrole" class="control-label"><?= __("action.user.Role") ?></label>
                        <div class="input-group date">
                            <select multiple="multiple" required name="listRoleId[]" class="form-control form-control-lg">
                                @foreach($roles as $key=>$role)
                                    <option name="role_id"
                                            {{($listRoleUser->contains($role->id) ? 'selected' : '')}}

                                            value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-addon">
                           <span class="glyphicon glyphicon-chevron-down"></span>
                        </span>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-default">{{trans('action.user.submit')}}</button>
                    <button type="reset" class="btn btn-default">{{trans('action.user.clear')}}</button>

                    <?= Form::close() ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
