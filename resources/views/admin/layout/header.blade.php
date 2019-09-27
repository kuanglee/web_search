<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{{ URL::to('/') }}}">Admin Area</a>
    </div>
    <!-- /.navbar-header -->

    <!-- Quick Actions -->
    <ul class="nav navbar-nav quick-actions">


        <li role="presentation" class="dropdown the-weather">
            <a class="date-top position-left"> <span id="localDate"></span> <span id="localTime"></span></a>
        </li>
        <!-- Weather -->
        <li class="dropdown divided temperature-main the-weather">
            <a class="temperature-icon position-left">
                <div class="weather-icon" style="padding-top: 0px ; margin-left: 200px" >
                    <i class="wi" id="main-icon" style="font-size: 20px;"></i>
                </div>
            </a>
            <a class="temperature-icon position-left">
                <p class="degrees"><span id="mainTemperature"></span><i class="wi wi-celsius"></i></p>
            </a>
        </li>
        <!-- Weather -->
        <li class="dropdown divided">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('images/flags/'.Session::get('locale').'.png')}}" class="position-left" alt="">
                <span class=" fa fa-angle-down"></span>
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list_lang" role="menu">
                <li>
                    <a href="{{asset('Switcher_Language/vn')}}" class="position-left">
                        <img src="{{asset('images/flags/vn.png')}}" alt=""> VietNam
                    </a>
                </li>
                <li>
                    <a href="{{asset('Switcher_Language/en')}}" class="position-left">
                        <img src="{{asset('images/flags/en.png')}}" alt=""> English
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /Quick Actions -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(Auth::user())
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>{{Auth::user()->name}}</a>
                    </li>

                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                @endif
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

@include('admin.layout.menu')
<!-- /.navbar-static-side -->
</nav>
