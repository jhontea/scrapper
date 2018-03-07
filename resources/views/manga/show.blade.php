@extends('layouts.manga')

@section('main')
<div id="main-wrapper">
    <div class="container">
        @include('manga.elements.breadcrumb')
        <div class="row">
            <div class="4u 12u(mobile)">
                <!-- Sidebar -->
                    <section class="box">
                        <a href="#" class="image featured"><img src="{{ asset($data->image) }}" alt="" style="width: 50%; margin: 40px auto;" /></a>
                        <header>
                            <h3>{{ $data->title }}</h3>
                        </header>
                        <p>
                            {{ $data->status }}<br>
                            {{ $data->author }}<br>
                            {{ $data->release }}<br>
                            {{ $data->category }}<br>
                            {{ $data->rating }}<br>
                        </p>
                    </section>
            </div>

            <div class="8u 12u(mobile) important(mobile)">
            <!-- Content -->
                <article class="box post">
                    <header>
                        <h2>Read Chapter</h2>
                        <p>{{ $data->title }}</p>
                    </header>
                    @if (count($data->mangaImages))
                        @foreach ($chapters as $chapter)
                        <a href="{{ $data->slug }}/chapter/{{ $chapter->chapter }}">
                            <p>Chapter {{ $chapter->chapter }}</p>
                        </a>
                        @endforeach
                    @else
                        <p><strong>-There are no chapter-</strong></p>
                    @endif
                </article>
            </div>
        </div>

    </div>
</div>

@endsection
