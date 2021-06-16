@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-md-2">
            @include("menu")
        </div>
        <div class="col-md-10">
            @csrf
            <input type="hidden" id="session" value="{{\Illuminate\Support\Facades\Session::token()}}" />
            <div id="map" class="map"></div>
            <ul class="list-group">
            </ul>
        </div>
    </div>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=0c9697e2-dadf-4f29-a505-ffb753f17733&lang=ru_RU" type="text/javascript"></script>
    <script src="/js/map.js" type="text/javascript"></script>
@endsection
