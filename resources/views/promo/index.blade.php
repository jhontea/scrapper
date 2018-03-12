@extends('layouts.promo')

@section('intro')
<section id="intro-anime" class="container">
    <header class="major custom-anime">
            <h2>Daily Promo</h2>
    </header>

    <div class="row">
        @foreach($datas as $data)
        <div class="4u 12u(mobile)">
            <a href="promo/{{ $data->slug }}">
                <section class="first">
                    <span class="image featured custom-anime {{ $data->slug }}"><img src="{{ $data->image }}" alt="" /></span>
                </section>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endsection
