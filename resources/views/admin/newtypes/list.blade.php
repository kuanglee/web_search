@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Type New
                        <small>List</small>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            ADD
                        </button>



                    </h1>
                </div>

                     @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
            @endif

                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unsigned name</th>
                        <th>Created_at</th>
                        {{--<th>Updated_at</th>--}}
                        {{--<th>--}}
                            {{--<button type="button" class="btn btn-primary" data-toggle="modal"--}}
                                    {{--data-target="#exampleModal">Add--}}
                            {{--</button>--}}
                        {{--</th>--}}
                        <th>Delete</th>
                        <th>Edit</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($typenew as $tn)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tn->id}}</td>
                            <td>{{$tn->Ten}}</td>
                            <td>{{$tn->TenKhongDau}}</td>
                            <td>{{$tn->created_at}}</td>
                            {{--<td>{{$ct->updated_at}}</td>--}}
                            {{--<td>Add</td>--}}
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a  href="admin/typenew/delete_typenew/{{$tn->id}}"  onclick="return confirm('Are you sure?');"   > Delete</a></td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/typenew/edit/1" data-id2="{{$tn->TenKhongDau}}"   data-name="{{$tn->Ten}}" data-id="{{$tn->id}}" data-toggle="modal" data-target="#edit_typenew">Edit</a></td>
                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">--}}
                                {{--Edit--}}
                            {{--</button>--}}
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





    <!-- Modal add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Type of New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="modal" action={{ action('typenewController@add_ajax') }} method="POST" enctype="multipart/form-data">
                        {{method_field('post')}}
                        {{csrf_field()}}

                        <div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" hidden for="id">ID</label>
                                <div class="col-sm-8" hidden>
                                    <input type="text"  hidden class="form-control" id="id" name="id">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="title">Name</label>
                            <div class="col-sm-8">
                                <input type="name" class="form-control" id="Ten" name="Ten">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="title">Type Of New</label>
                            <div class="col-sm-8">
                                {{--<input type="name" class="form-control" id="TenKhongDau" name="TenKhongDau">--}}
                                <select id="id2" name="TenKhongDau" class="form-control form-control-lg">
                                    {{--<option selected>Open this select menu</option>--}}
                                    @foreach($category as $ct)
                                    <option value="{{$ct->id}}">{{$ct->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class="glyphicon glyphicon"></span>close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--// modal edit--}}
    <!-- Modal add -->
    <div class="modal fade" id="edit_typenew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Type New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="modal" action="admin/typenew/edit_ajax" method="POST" enctype="multipart/form-data">
                        {{method_field('post')}}
                        {{csrf_field()}}

                        {{--<div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-sm-4" for="id">ID</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" disabled class="form-control" id="id" name="id">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" for="id">ID</label>
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control"  id="id" name="id">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="title">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="Ten">
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="control-label col-sm-4" for="title" >Unsigned Name</label>
                            <div class="col-sm-8">
                                {{--<input type="text" class="form-control" id="id2" name="TenKhongDau">--}}
                                <select id="TenKhongDau" name="TenKhongDau" class="form-control form-control-lg">
                                    {{--<option selected>Open this select menu</option>--}}
                                    @foreach($category as $ct)
                                        <option value="{{$ct->id}}">{{$ct->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class="glyphicon glyphicon"></span>close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection