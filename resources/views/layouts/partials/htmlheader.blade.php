<head>
    <meta charset="UTF-8">
    <title> {{ config('adminlte.pageTitle') }} - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  
@section('headerstyles')  
    @foreach($layout->styles as $style)
        <!-- {{ $style['info'] }} -->
        <link href="{{ isset($style['external']) ? $style['external'] : asset($style['path']) }}" rel="stylesheet" type="text/css" />
    @endforeach
@show
  

@section('headershims')
    @foreach($layout->shims as $shim)
        <!--[if {{ $shim['condition']}}]>
                        
        @if(isset($shim['scripts']))
            
            @foreach($shim['scripts'] as $script)
                @if(in_array('*',$script['context']))
                    <!-- {{ $script['info'] }} -->
                    <script src="{{ isset($script['external']) ? $script['external'] : asset($script['path']) }}"  ></script>
            @endif
            @endforeach
        @endif    
        
        @if(isset($shim['styles']))
            @foreach($shim['styles'] as $style)
                <!-- {{ $style['info'] }} -->
                <link href="{{ isset($style['external']) ? $style['external'] : asset($style['path']) }}" rel="stylesheet" type="text/css" />
            @endforeach
        @endif
        
        <![endif]-->
    @endforeach
@show
</head>
