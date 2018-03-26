<div class="navbar navbar-default header-highlight">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="{{asset('public/assets/')}}/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            <li><a class="sidebar-mobile-detached-toggle"><i class="icon-grid7"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            <li>
                <a class="sidebar-control sidebar-detached-hide hidden-xs">
                    <i class="icon-drag-left"></i>
                </a>
            </li>
        </ul>

        <div class="navbar-right">
            <p class="navbar-text">Good <?php $time = date('H',strtotime('+6 hours')); echo ($time >= 05 && $time < 12 ) ?'Morning': ($time >= 12 && $time < 15) ? 'Noon' : ($time >= 15 && $time < 19) ?'After Noon' : ' Night'  ;?>, {{ Auth::User()->name }}!</p>
            <p class="navbar-text"><span class="label bg-success">Online</span></p>

            <ul class="nav navbar-nav">
                <li>
                    <a  href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> <span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                </li>
            </ul>
        </div>
    </div>
</div>