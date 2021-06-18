@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-md-2">
            @include("menu")
        </div>
        <div class="col-md-10">
            @csrf
            <input type="hidden" id="session" value="{{\Illuminate\Support\Facades\Session::token()}}" />
            <div class="row">
            <div class="col-md-9">
                <div id="map" class="map"></div>
            </div>
            <div class="col-md-3">
                <ul id="objects" class="list-group">
                </ul>
            </div>
            </div>
        </div>
    </div>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvxgcxq6qGtu16c5eqq2IJyf5P7AFvA3c&callback=initMap&libraries=places"></script>
    <script src="/js/map.js" type="text/javascript"></script>
@endsection
