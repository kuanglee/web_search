@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>view</small>
                        <a href="{{url('admin/users/add')}}" type="button" class="btn btn-success" >Add
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
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <form method="POST"
                                      action="{{ url('/admin/users/destroy', ['id' => $user->id]) }}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href=""
                                                                                     >Edit</a>
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
