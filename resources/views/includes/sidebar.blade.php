<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="{{asset('public/assets/')}}/images/placeholder.jpg" class="img-circle img-responsive" alt=""></a>
                    <h6>{{ Auth::user()->name }}</h6>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i class="icon-switch2"></i> <span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                </div>
            </div>

        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="active"><a href="{{ route('home') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li class=""><a href="{{ route('tenants.index') }}"><i class="icon-users4"></i> <span>Tenants Details</span></a></li>
                    <li class=""><a href="{{ route('payments.index') }}"><i class="icon-coins"></i> <span>Payment Details</span></a></li>
                    <li class=""><a href="{{ route('expenses.index') }}"><i class="icon-cash3"></i> <span>Expense Details</span></a></li>
                    <li class=""><a href="{{ route('report.index') }}"><i class="icon-stats-decline"></i> <span>Reports</span></a></li>

                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>