@extends('layouts.anime')

@section('main')
<div id="main-wrapper">
    <div class="container">
        <div class="row">
            <div class="4u 12u(mobile)">
                <!-- Sidebar -->
                    <section class="box">
                        <a href="#" class="image featured {{ $store->slug }}"><img src="{{ asset($store->image) }}" alt="" style="width: 50%; margin: 40px auto;" /></a>
                    </section>
            </div>

            <div class="8u 12u(mobile) important(mobile)">
            <!-- Content -->
                <article class="box post">
                    <header>
                        <h2>Promo</h2>
                    </header>
                    @foreach ($datas as $data)
                    <img src="{{ asset($data) }}" alt="" />
                    @endforeach
                </article>
            </div>
        </div>

    </div>
</div>

@endsection
