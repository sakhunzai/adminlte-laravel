@foreach($layout->scripts as $script)
    @if(in_array('auth',$script['context']))
    <!-- {{ $script['info'] }} -->
    <script src="{{ isset($script['external']) ? $script['external'] : asset($script['path']) }}"  ></script>
    @endif
@endforeach