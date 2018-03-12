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
            <form id="registerSubmit">
                {{ csrf_field() }}
                <section class="first">
                    <a href="{!! $data['url'] !!}" target="_blank">
                        <span class="image featured custom-anime"><img src="{{ $data['img'] }}" alt="" /></span>
                        <header>
                            <h3 style="height:60px">{{ $data['title'] }}</h3>
                            Episode {{ $data['episode'] }}
                        </header>
                    </a>
                </section>
                <input type='hidden' name="title" value="{{ $data['title'] }}">
                <input type='hidden' name="slug" value="{{ $data['slug'] }}">
                <input type='hidden' name="image" value="{{ $data['img'] }}">
                <button class="button alt save" value="{{ $data['title'] }}">Save</button>
            </form>
        </div>
    @endforeach
@endforeach
    </div>
</section>
@endsection

@section('page-script')
<script>
$('form').submit(function (event) {
    event.preventDefault()

    swal({
        title: "Are you sure?",
        text: "You want to save this anime?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willSave) => {
        if (willSave) {
            var dataForm = $(this).serialize()
            $.ajax({
                type: "POST",
                url: "/crawler/anime",
                data: dataForm,
                dataType: "json",
                success: function(data) {
                    swal(data.info, data.message, data.alert);
                },
                error: function(data) {
                    swal(data.responseJSON.info, data.responseJSON.message, "error");
                }
            });
        } else {
            swal("Your canceled save this anime");
        }
    });

    
    
})
</script>
@endsection
