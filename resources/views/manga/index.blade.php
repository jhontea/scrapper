@extends('layouts.manga')

@section('intro')
<section id="intro" class="container">
    <header class="major custom">
            <h2>Daily Manga</h2>
    </header>
    <div class="row">
    @foreach(array_slice($daily, 0, 3) as $d)
        <div class="4u 12u(mobile)">
            <a href="manga/{{ $d['slug'] }}/chapter/{{ $d['chapter'] }}">
                <section class="first">
                    <span class="image featured custom"><img src="{{ $d['img'] }}" alt="" /></span>
                    <header>
                        <h2>{{ $d['title'] }}</h2>
                    </header>
                    <p>Chapter {{ $d['chapter'] }}</p>
                </section>
            </a>
        </div>
    @endforeach
    </div>
    <footer>
        <ul class="actions">
            <li><a href="{{ 'manga/add-manga' }}" class="button big">Scrape and Add More</a></li>
        </ul>
    </footer>

    <header class="major custom">
        <h2>Other Update</h2>
    </header>
    <div class="row">
        <div class="12u 12u(mobile)">
            <section>
                <ul>
                    @foreach(array_slice($daily, 3) as $d)
                    <li style="padding: 0 0 20px 0">
                        <a href="manga/{{ $d['slug'] }}/chapter/{{ $d['chapter'] }}">
                            <h3>{{ $d['title'] }}</h3>
                            <span class="date">Chapter {{ $d['chapter'] }} </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
</section>
@endsection
