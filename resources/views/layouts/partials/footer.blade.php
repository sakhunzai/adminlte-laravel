<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
       <strong>
          Copyright &copy; {{date('Y')}} <a href="{{$layout->package['company']['url']}}">{{$layout->package['company']['name']}}</a>.
       </strong>
       Created by 
       @foreach($layout->package['authors'] as $author)
       <a href="{{$author['url']}}">{{$author['name']}}</a>.
        @if(isset($author['repo']))
            Repo @ <a href="{{$author['repo']}}">Github</a>
        @endif
       @endforeach
    </div>
    <!-- Default to the left -->
    <a href="{{$layout->package['url']}}">{!! $layout->logoLarge !!}</a>.{{$layout->package['description']}}
</footer>