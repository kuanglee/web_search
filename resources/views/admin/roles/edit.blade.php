@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{trans('action.user.Role')}}
                        <small>{{trans('action.role.edit')}}</small>
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

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <?= Form::open(['url' => '/admin/roles/update', "id" => "frmValidate", "enctype" => "multipart/form-data"]); ?>
                    @csrf()
                    @method('POST')
                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.role.name')}}</label>
                        <input type="text" name="name" class="form-control" required
                               value="{!! old('name' ,isset($roles) ? $roles->name : null) !!}"
                               placeholder="{{trans('action.role.placeholder.name')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('name')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.role.description')}}</label>
                        <input type="text" name="description" class="form-control" required
                               value="{!! old('description' ,isset($roles) ? $roles->email : null) !!}"
                               placeholder="{{trans('action.role.placeholder.description')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('name')!!}</p>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label"> {{trans('action.role.display_name')}}</label>
                        <input type="text" name="display_name" class="form-control" required
                               value="{!! old('display_name' ,isset($roles) ? $roles->display_name : null) !!}"
                               placeholder="{{trans('action.role.placeholder.display_name')}}">
                        <p class="help-block" style="color:red;">{!! $errors->first('display_name')!!}</p>
                    </div>



                    <div class="form-group">
                        <label for="inputrole" class="control-label"><?= __("action.role.Permission") ?></label>
                        <div class="input-group date">
                            <select style="height: 170px" multiple="multiple" required name="listPermissionId[]" class="form-control form-control-lg">
                                @foreach($listPermission as $permission)
                                    <option name="role_id"
                                            {{($listPermissionRole->contains($permission->id) ? 'selected' : '')}}
                                            value="{{$permission->id}}">{{$permission->name}}</option>
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
