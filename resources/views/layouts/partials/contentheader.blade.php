<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>

@if(count($layout->breadcrumbs))
    <ol class="breadcrumb">
        @foreach ($layout->breadcrumbs as $bc)
            @if(!@isset($bc['active']))
                <li><a href="{{ $bc['link'] }}"><i class="{{ $bc['class'] }}"></i>{{ $bc['name'] }}</a></li>
            @else
                <li class="{{ $bc['class'] }}">{{ $bc['name'] }}</li>
            @endif
        @endforeach
    </ol>
@endif
</section>