@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loai Tin
                        <small>view</small>
                        <a href="{{url('admin/loaitin/add')}}" type="button" class="btn btn-success"  data-toggle="modal">Add
                        </a>


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

                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>


                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unmarker Name</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loaitin as $lt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->Ten}}</td>
                            <td>{{$lt->TenKhongDau}}</td>
                            <td>{{$lt->created_at}}</td>
                            <td>{{$lt->updated_at}}</td>
                            <td>
                                <form method="POST"
                                      action="{{ url('/admin/loaitin/destroy', ['id' => $lt->id]) }}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url("/admin/loaitin/edit", ['id' => $lt->id])}}">Edit</a>
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


@endsection
