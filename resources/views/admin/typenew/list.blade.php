@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Type new
                        <small>view</small>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add
                        </button>


                    </h1>
                    {{--<div><button type="button" class="btn btn-success">Success</button></div>--}}
                </div>
                <!-- /.col-lg-12 -->
                <!-- /.col-lg-12 -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tiêu đề không dấu</th>
                        <th>Tóm tắt</th>
                        <th>Nội dung</th>
                        <th>Hình</th>
                        <th>Số lượt xem</th>
                        <th>idLoaiTin</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($typenews as $type)
                        <tr class="odd gradeX" align="center">
                            <td>{{$type->id}}</td>
                            <td>{{$type->TieuDe}}</td>
                            <td>{{$type->TieuDeKhongDau}}</td>
                            <td>{{$type->TomTat}}</td>
                            <td>{{$type->NoiDung}}</td>
                            <td>{{$type->Hinh}}</td>
                            <td>{{$type->SoLuotXem}}</td>
                            <td>{{$type->idLoaiTin}}</td>
                            <td>{{$type->created_at}}</td>
                            <td>{{$type->updated_at}}</td>
                            <td>
                                <form method="POST"
                                      action="{{ url('/admin/typenews/destroy', ['id' => $type->id]) }}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href=""
                                                                                     data-id="{{$type->id}}"
                                                                                     data-id2="{{$type->id}}"
                                                                                     data-Name="{{$type->TieuDe}}"
                                                                                     data-kuang="{{$type->TieuDe}}"
                                                                                     data-noidung="{{$type->NoiDung}}"
                                                                                     data-tomtat="{{$type->TomTat}}"
                                                                                     data-idloaitin = "{{$type->idLoaiTin}}"
                                                                                     data-toggle="modal"
                                                                                     data-target="#edit-typenew-modal">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    {{--// modal--}}
    <!-- The Modal add type new -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Type New Add</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url('admin/typenews/store')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" name="TieuDe" id="TieuDe">
                        </div>

                        <div class="form-group">
                            <label for="title">Tóm tắt</label>
                            <input type="text" class="form-control" name="TomTat" id="TomTat">
                        </div>

                        <div class="form-group">
                            <label for="title">Nội dung</label>
                            <input type="text" class="form-control" name="NoiDung" id="NoiDung">
                        </div>

                        <div class="form-group">
                            <label for="title">Hình</label>
                            <input type="file" class="custom-file-input" id="Hinh" name="Hinh">
                        </div>

                        <div class="form-group">
                            <label for="title">Loại tin</label>
                            <select class="form-control" id="idLoaiTin" name="idLoaiTin" >
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->Name}}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>






    <!-- Attachment Modal -->
    <div class="modal fade" id="edit-typenew-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachment-body-content">
                    <form action="{{url('admin/typenews/updateAjax')}}" method="post">
                        {{csrf_field()}}

                        <div class="card text-white bg-dark mb-0">

                            <div class="card-body" style="padding-left: 30px">

                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">ID</label>
                                    <input type="text" name="id" class="form-control"
                                           id="id" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">Tieu De</label>
                                    <input type="Name" name="TieuDe" class="form-control"
                                           id="kuang" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">Tóm Tắt</label>
                                    <input type="Name" name="TomTat" class="form-control"
                                           id="tomtat" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">Nội Dung</label>
                                    <input type="Name" name="NoiDung" class="form-control"
                                           id="noidung" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="title">Loại tin</label>
                                    <select class="form-control" id="idloaitin" name="idLoaiTin" >
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}">{{$category->Name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">Hình</label>
                                    <input type="file" class="custom-file-input" id="Hinh" name="Hinh">
                                </div>




                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- /Attachment Modal -->
@endsection
