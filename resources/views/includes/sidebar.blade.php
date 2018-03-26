<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content text-center">
                    <?php $image = Auth::user()->image; if(!file_exists($image)) { $image = 'public/assets/images/placeholder.jpg' ;}?>
                    <img src="{{asset($image)}}" class="img-circle img-responsive " style="margin: 0 auto ; width: 100px;" alt="{{ Auth::user()->name }}">
                    <h6>{{ Auth::user()->name }}</h6>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                </div>

            </div>
            <div class="navigation-wrapper collapse {{ (Route::currentRouteName() == 'register' || Route::currentRouteName() == 'account.index') ? 'in' : ' ' }}" id="user-nav">
                <ul class="navigation">
                    <li class="{{ (Route::currentRouteName() == 'register') ? 'active' : ' ' }}"><a href="{{ route('register') }}"><i class="icon-user-plus"></i> <span>Add Admin</span></a></li>
                    <li class="divider"></li>
                    <li class="{{ (Route::currentRouteName() == 'account.index') ? 'active' : ' ' }}"><a href="{{ route('account.index') }}"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                    <li class="divider"></li>
                    <li ><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i class="icon-switch2"></i> <span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form></li>
                </ul>
            </div>

        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="{{ (Route::currentRouteName() == 'home') ? 'active' : ' ' }}"><a href="{{ route('home') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li class="{{ (strpos( Route::currentRouteName(), 'tenants' ) !== false)?'active':' ' }}"><a href="{{ route('tenants.index') }}"><i class="icon-users4"></i> <span>Tenants Details</span></a></li>
                    <li class="{{ (strpos( Route::currentRouteName(), 'payments' ) !== false)?'active':' ' }}"><a href="{{ route('payments.index') }}"><i class="icon-coins"></i> <span>Payment Details</span></a></li>
                    <li class="{{ (strpos( Route::currentRouteName(), 'expenses' ) !== false)?'active':' ' }}"><a href="{{ route('expenses.index') }}"><i class="icon-cash3"></i> <span>Expense Details</span></a></li>
                    <li class="{{ (strpos( Route::currentRouteName(), 'report' ) !== false)?'active':' ' }}"><a href="{{ route('report.index') }}"><i class="icon-stats-decline"></i> <span>Reports</span></a></li>

                    @if(Auth::user()->id == 1)
                    <li class="{{ (strpos( Route::currentRouteName(), 'rating' ) !== false)?'active':' ' }}"><a href="{{ route('rating.view') }}"><i class="icon-stats-decline"></i> <span>User Rating</span></a></li>
                    @endif
                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>