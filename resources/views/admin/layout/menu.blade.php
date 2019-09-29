<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="admin/dictionary"><i class="glyphicon glyphicon-book"></i> Dictionary<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/dictionary/add">Add Dictionary</a>
                    </li>
                    <li>
                        <a href="admin/dictionary/list">List Dictionary</a>
                    </li>

                    <li>
                        <a href="admin/dictionary/search">Search Dictionary</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/theloai/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i> Thể loại<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('admin/categorys')}}">Danh Sách Thể loại</a>
                    </li>
                    <li>
                        <a href="admin/theloai/them">Thêm thể loại</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/loaitin/danhsach"><i class="glyphicon glyphicon-credit-card"></i> Loại tin<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/loaitin/">Danh Sách Loại tin</a>
                    </li>
                    <li>
                        <a href="admin/loaitin/add">Thêm Loại tin</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/typenews"><i class="fa fa-newspaper-o"></i> Tin Tức<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/typenews">Danh Sách Tin tức</a>
                    </li>
                    <li>
                        <a href="admin/tintuc/them">Thêm Tin tức</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/slide/danhsach"><i class="fa fa-sliders"></i> Slide<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/slide/danhsach">Danh Sách Tin tức</a>
                    </li>
                    <li>
                        <a href="admin/slide/them">Thêm Tin tức</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/roles"><i class="glyphicon glyphicon-tower"></i> Roles<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url("admin/roles")}}">Danh Sách Roles</a>
                    </li>
                    <li>
                        <a href="{{url("admin/roles/add")}}">Thêm Tin tức</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/roles"><i class="glyphicon glyphicon-shopping-cart"></i> {{trans('action.shop.shop')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url("admin/shops")}}">{{trans('action.shop.list_shops')}}</a>
                    </li>
                    <li>
                        <a href="{{url("admin/shops/add")}}">{{trans('action.shop.add_shop')}}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="admin/user/danhsach"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('admin/users')}}">List Account</a>
                    </li>
                    <li>
                        <a href="#">Add Account</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
