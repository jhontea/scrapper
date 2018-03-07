@extends('layouts.manga')

@section('main')
<!-- Main -->
<div id="main-wrapper">
    <div class="container">
    @if (Session::has('message'))
        <div class="row">
            <div class="12u">
                    <div class="alert {{ Session::pull('status') }}">{{ Session::pull('message') }}</div>
            </div>
        </div>
    @endif

        <!-- Content -->
            <article class="box post">
                <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
                <header>
                    <h2>Manga Release</h2>
                    <p>List Latest Manga Release</p>
                </header>
            </article>
        
        <div class="row">
            <div class="12u">
                    <section>
                        <header class="major">
                            <h2>Latest Release</h2>
                        </header>
                        <div class="row">
                        @foreach($scrape as $data)
                            <div class="4u 12u(mobile)">
                                <form method="POST" action="{{ route('manga.save') }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="mangaSlug" value="{{ $data['slug'] }}">
                                    <section class="box">
                                        <header>
                                            <h5>{{ $data['title'] }}</h3>
                                        </header>
                                        <p>Chapter {{ $data['chapter'] }}</p>
                                        <footer>
                                            <button type="submit" class="button alt">Save</a>
                                        </footer>
                                    </section>
                                </form>
                            </div>
                        @endforeach
                        </div>
                    </section>
            </div>
        </div>

    </div>
</div>
@endsection