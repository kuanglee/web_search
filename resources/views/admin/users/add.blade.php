@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Thêm</small>
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
                    <form action="{{url('admin/users/store')}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Xin vui lòng nhập Tên "/>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email"
                                   placeholder="Xin vui lòng nhập tên Email "/>
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" name="address" placeholder="Xin vui lòng nhập địa chỉ "/>
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input class="form-control" type="password" name="password"
                                   placeholder="Xin vui lòng nhập password "/>
                        </div>

                        <div class="form-group">
                            <label>Xác thực mật khẩu</label>
                            <input class="form-control" type="password" name="confirm_password"
                                   placeholder="Xin vui lòng nhập password xác thực "/>
                        </div>

                        <div class="form-group">
                            <label for="inputrole" class="control-label"><?= __("action.user.Role") ?></label>
                            <div class="input-group date">
                                <select multiple="multiple" required name="listRoleId[]" class="form-control form-control-lg">
                                    @foreach($roles as $key=>$role)
                                        <option name="role_id" value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-addon">
                           <span class="glyphicon glyphicon-chevron-down"></span>
                        </span>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
