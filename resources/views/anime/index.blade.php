@extends('layouts.anime')

@section('intro')
<section id="intro-anime" class="container">
    <header class="major custom-anime">
            <h2>Daily Anime</h2>
    </header>

    <!-- Notif -->
    @if (Session::has('message'))
        <div class="row">
            <div class="12u">
                    <div class="alert {{ Session::pull('status') }}">{{ Session::pull('message') }}</div>
            </div>
        </div>
    @endif

    <div class="row">
@foreach($dataScrappers as $datas)
    @foreach($datas as $data)
        <div class="4u 12u(mobile)">
            <section class="first">
                <a href="{!! $data['url'] !!}" target="_blank">
                    <span class="image featured custom-anime"><img src="{{ $data['img'] }}" alt="" /></span>
                    <header>
                        <h3>{{ $data['title'] }}</h3>
                        Episode {{ $data['episode'] }}
                    </header>
                
                </a>
            </section>
            <a href="" class="button alt">Save</a>
        </div>
    @endforeach
@endforeach
    </div>
</section>
@endsection
