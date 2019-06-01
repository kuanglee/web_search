@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dictionary
                        <small>@if(isset($data->id))
                                   Edit

                            @else
                                   Add

                            @endif
                        </small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div>
                @if(count($errors)>0)
                    <!--dem so loi -->
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach()
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>


            </div>
            @if(isset($data->id))
                <form action="admin/dictionary/edit/{{$data->id}}" accept-charset="UTF-8" method="POST">
            @else
                <form action="{{route('admin.dictionary.add')}}" accept-charset="UTF-8" method="POST">
            @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea3">Japanese</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="dic_japanese" rows="10" required>@if(isset($data->id)){{$data->japanese}}@endif</textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea2">Vietnamese</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2"rows="10" required name="dic_vietnamese">@if(isset($data->id)){{$data->vietnamese}}@endif</textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea2">English</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2"rows="10" required name="dic_english">@if(isset($data->id)){{$data->english}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">@if(isset($data->id))
                        Edit

                    @else
                        Add

                    @endif</button>
                <button type="reset" class="btn btn-default">Refresh</button>
                <form>
                    <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
