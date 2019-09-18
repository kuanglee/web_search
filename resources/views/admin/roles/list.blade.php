@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{trans('action.user.Role')}}
                        <small>view</small>
                        <a href="{{url('admin/roles/add')}}" type="button" class="btn btn-success" >{{trans('action.role.add')}}
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
                        <th>{{trans('action.role.id')}}</th>
                        <th>{{trans('action.role.name')}}</th>
                        <th>{{trans('action.role.description')}}</th>
                        <th>{{trans('action.role.display_name')}}</th>
                        <th>{{trans('action.role.created_at')}}</th>
                        <th>{{trans('action.role.updated_at')}}</th>
                        <th>{{trans('action.role.delete')}}</th>
                        <th>{{trans('action.role.edit')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="odd gradeX" align="center">
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>{{$role->updated_at}}</td>
                            <td>
                                <form method="POST"
                                      action="{{ url('/admin/roles/destroy', ['id' => $role->id]) }}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                            class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url("admin/roles/edit" , ['id' => $role->id])}}">Edit</a>
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
