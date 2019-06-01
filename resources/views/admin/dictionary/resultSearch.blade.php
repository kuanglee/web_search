@extends('admin.dictionary.searchDictionary')

@section('result_search')


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Result</small>
                    </h1>
                </div>
                {{--<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Vietnamese</th>
                        <th scope="col">japanese</th>
                        <th scope="col">English</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->vietnamese}}</td>
                        <td>{{$data->japanese}}</td>
                        <td>{{$data->english}}</td>


                    </tbody>

                </table>--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            &emsp;<label>
                                Key: @if($key == 1)
                                        {{$data->vietnamese}}
                                      @elseif($key == 2)
                                         {{$data->vietnamese}}
                                      @elseif($key == 3)
                                         {{$data->japanese}}
                                      @elseif($key == 4)
                                         {{$data->japanese}}
                                      @elseif($key == 5)
                                         {{$data->english}}
                                      @elseif($key == 6)
                                         {{$data->english}}

                                     @endif
                            </label><br>
                            &emsp;<label> Value:
                                @if($key == 1)
                                    {{$data->english}}
                                @elseif($key == 2)
                                    {{$data->japanese}}
                                @elseif($key == 3)
                                    {{$data->vietnamese}}
                                @elseif($key == 4)
                                    {{$data->english}}
                                @elseif($key == 5)
                                    {{$data->vietnamese}}
                                @elseif($key == 6)
                                    {{$data->japanese}}

                                @endif
                            </label>

                        </div>
                    </div>


                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

@endsection
