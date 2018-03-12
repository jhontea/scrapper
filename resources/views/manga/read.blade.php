@extends('layouts.manga')

@section('main')
<div id="main-wrapper">
    <div class="container">

        @include('manga.elements.breadcrumb')

        <!-- Content -->
            <article class="box post">
                @if (count($data))
                    @foreach ($data as $manga)
                    <a href="#" class="image featured"><img src="{{ asset($manga->image) }}" alt="" style="margin: auto"/></a><br>
                    @endforeach
                @else
                    <p><strong>-There are no chapter-</strong></p>
                @endif
            </article>

    </div>
</div>


@endsection

@section('page-script')
<script>
    $(".container").css({
        'width' : '60%',
    })
</script>
@endsection