@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{trans('action.Dashboard')}}</h1>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-blue panel-widget ">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <svg class="glyph stroked app-window-with-content">
                                    <use xlink:href="#stroked-app-window-with-content"/>
                                </svg>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large">{{$countNews}}</div>
                                <div class="text-muted">{{trans('action.total_news')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <svg class="glyph stroked app-window-with-content">
                                    <use xlink:href="#stroked-app-window-with-content"/>
                                </svg>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large">{{$countTypeNews}}</div>
                                <div class="text-muted">{{trans('action.type_news')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-orange panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <svg class="glyph stroked bag">
                                    <use xlink:href="#stroked-bag"/>
                                </svg>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large">{{$countCategories}}</div>
                                <div class="text-muted">{{trans('action.total_categories')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large">{{$countUsers}}</div>
                                <div class="text-muted">{{trans('action.total_users')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{trans('action.tong_quan')}}</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <canvas class="main-chart" id="line-chart" height="100" width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Đơn hàng mới</h4>
                            <div class="easypiechart" id="easypiechart-blue" data-percent="92"><span
                                        class="percent">92%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Đánh giá mới</h4>
                            <div class="easypiechart" id="easypiechart-orange" data-percent="65"><span class="percent">65%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Khách hàng mới</h4>
                            <div class="easypiechart" id="easypiechart-teal" data-percent="56"><span
                                        class="percent">56%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Lượt truy cập</h4>
                            <div class="easypiechart" id="easypiechart-red" data-percent="27"><span
                                        class="percent">27%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->

        </div>    <!--/.main-->
        <!-- =====================================main content - noi dung chinh trong chu -->

    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
