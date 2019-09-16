@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Loại Tin
                        <small>{{$loaitin->Ten}}</small>
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
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                        <?= Form::open(['url' => '/admin/loaitin/update/' . $id, "id" => "frmValidate", "enctype" => "multipart/form-data"]); ?>
                        @csrf()
                        @method('PATCH')
                        <div class="form-group">
                            <label>Thể Loại</label>
                            <select class="form-control" name="idTheLoai">
                                @foreach($theloai as $tl)
                                    <option
                                            @if($loaitin->idTheLoai == $tl->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên Loại Tin</label>
                            <input class="form-control" value="{{$loaitin->Ten}}" name="Ten" placeholder="Xin vui lòng nhập tên " />
                        </div>

                        <button type="submit" class="btn btn-default">Chỉnh sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>

                        <?= Form::close() ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
