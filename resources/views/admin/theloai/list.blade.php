@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
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
                        <th>Name</th>
                        <th>Unmarker Name</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCategorys as $category)
                        <tr class="odd gradeX" align="center">
                            <td>{{$category->id}}</td>
                            <td>{{$category->Name}}</td>
                            <td>{{$category->Unmarker_name}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td>
                                <form method="POST"
                                      action="{{ url('/admin/categorys/destroy', ['id' => $category->id]) }}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href=""
                                                                                     data-id="{{$category->id}}"
                                                                                     data-Name="{{$category->Name}}"
                                                                                     data-kuang="{{$category->Name}}"
                                                                                     data-toggle="modal"
                                                                                     data-target="#edit-modal">Edit</a>
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
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Category Add</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url('admin/categorys/store')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" name="Name" id="Name">
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
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
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
                <form action="{{url('admin/categorys/updateAjax')}}" method="post">
                    {{csrf_field()}}

                        <div class="card text-white bg-dark mb-0">

                            <div class="card-body" style="padding-left: 30px">


                                <!-- id -->
                                <!-- name -->
                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">ID</label>
                                    <input type="text" name="id" class="form-control" disabled=""
                                           id="id" required autofocus>
                                </div>
                                <!-- /name -->
                                <!-- /id -->



                                <!-- name -->
                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-name">Name</label>
                                    <input type="Name" name="kuang" class="form-control"
                                           id="kuang" required autofocus>
                                </div>
                                <!-- /name -->



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
