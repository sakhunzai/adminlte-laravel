@if($layout->showSidebar)
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    
        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ $layout->profileImg  }}" class="img-circle avatar" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        @if($layout->showSideSearch)
        <!-- search form (Optional) -->
           @include('adminlte::layouts.partials.menu.left_search')
        <!-- /.search form -->
        @endif

        @if($layout->showSideMenu)
        <!-- Sidebar Menu -->
            @include('adminlte::layouts.partials.menu.left_menu')
        <!-- /.sidebar-menu -->
       @endif
    </section>
    <!-- /.sidebar -->
</aside>
@endif
