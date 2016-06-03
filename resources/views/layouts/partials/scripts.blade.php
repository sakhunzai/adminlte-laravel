@section('footerscripts')  
        <!-- REQUIRED JS SCRIPTS -->
        
    @foreach($layout->scripts as $script)
        @if(in_array('*',$script['context']))
        <!-- {{ $script['info'] }} -->
        <script src="{{ isset($script['external']) ? $script['external'] : asset($script['path']) }}"  ></script>
        @endif
    @endforeach
@show

    <!-- USER SCRIPTS -->
    @yield('user-scripts')