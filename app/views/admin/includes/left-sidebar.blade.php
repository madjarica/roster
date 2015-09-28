<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">

                <img src="{{ Auth::user()->profile_image }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::route('admin-change-password') }}">Change password</a></li>
                    <li><a href="{{ URL::route('admin-change-profile-image') }}">Change profile image</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::route('admin-add-user') }}">Create User</a></li>
                    <li><a href="{{ URL::route('admin-view-users') }}">View Users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Jobs</span>
                    <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::route('admin-job-creator') }}">Create Job</a></li>
                    <li><a href="{{ URL::route('admin-view-jobs') }}">View Jobs</a></li>
                </ul>
            </li>

            <li><a href="{{ URL::route('admin-setup-filters') }}"><i class="fa fa-filter"></i>Setup Filters</a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-paperclip"></i> <span>Applications</span>
                    <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="">View All Applications</a></li>
                    <li><a href="">View Approved only Applications</a></li>
                </ul>
            </li>


            {{--<li class="active"><a href="#"><span>Link</span></a></li>--}}
            {{--<li><a href="#"><span>Another Link</span></a></li>--}}
            {{--<li class="treeview">--}}
            {{--<a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="#">Link in level 2</a></li>--}}
            {{--<li><a href="#">Link in level 2</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>