@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dictionary
                        <small>view</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Vietnamese</th>
                        <th>Japanese</th>
                        <th>English</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>updated_at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dictionary as $dt)
                    <tr class="odd gradeX" align="center">
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->vietnamese}}</td>
                        <td>{{$dt->japanese}}</td>
                        <td>{{$dt->english}}</td>
                        <td>{{$dt->status}}</td>
                        <td>{{$dt->created_at}}</td>
                        <td>{{$dt->updated_at}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/dictionary/delete/{{$dt->id}}" onclick="return confirm('Are you sure?')"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/dictionary/edit/{{$dt->id}}">Edit</a></td>
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
