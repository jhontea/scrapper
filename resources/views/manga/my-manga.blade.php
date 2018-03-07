@extends('layouts.manga')

@section('main')
<div id="main-wrapper">
    <div class="container">
        <div class="row">
            <div class="12u">

                <!-- Portfolio -->
                    <section>
                        <header class="major">
                            <h2>My Manga</h2>
                        </header>
                        <div class="row">
                        @foreach($datas as $data)
                            <div class="4u 12u(mobile)">
                                <section class="box">
                                    <a href="{{ $data->slug }}" class="image featured"><img src="{{ asset($data->image) }}" alt="" style="width: 50%; margin: 40px auto;"/></a>
                                    <header>
                                        <h3>{{ $data->title }}</h3>
                                    </header>
                                    <!-- <p>Lorem ipsum dolor sit amet sit veroeros sed amet blandit consequat veroeros lorem blandit  adipiscing et feugiat phasellus tempus dolore ipsum lorem dolore.</p> -->
                                    <footer>
                                        <a href="{{ $data->slug }}" class="button alt">Read</a>
                                    </footer>
                                </section>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
        </div>
    </div>
</div>

@endsection