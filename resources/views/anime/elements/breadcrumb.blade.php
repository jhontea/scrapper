<ol class="breadcrumb">
    <li><a href="/crawler/manga">Home</a></li>
    @foreach ($breadcrumbs as $breadcrumb)
    <li>
        @if(isset($breadcrumb['url']))
        <a href="{{ $breadcrumb['url'] }}">
            {{ $breadcrumb['name'] }}
        </a>
        @else
        {{ $breadcrumb['name'] }}
        @endif
    </li>    
    @endforeach
</ol>