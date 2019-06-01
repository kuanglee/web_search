@extends('admin.dictionary.searchDictionary')

@section('result_search')


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Result</small>
                    </h1>
                </div>
                <table class="table">
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

                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

@endsection
