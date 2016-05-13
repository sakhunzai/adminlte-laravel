<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="{{ $layout->skinStyle }} sidebar-mini">
<div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')
    
    <!-- profile edit form  -->
    @include('adminlte::partials.profile')
     
    @include('adminlte::layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('adminlte::layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @if($layout->showSidebar)
        @include('adminlte::layouts.partials.controlsidebar')
    @endif    

    @if($layout->showFooter)
        @include('adminlte::layouts.partials.footer')
    @endif    

</div><!-- ./wrapper -->

@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show

</body>
</html>
