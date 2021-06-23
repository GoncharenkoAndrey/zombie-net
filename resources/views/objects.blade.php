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
                <div class="col-md-6">
                    <div id="map" class="map"></div>
                </div>
                <div class="col-md-3">
                    @if(count($objects) == 0)
                        Объекты не найдены
                    @endif
                    <ul id="objects" class="list-group">
                        @foreach($objects as $object)
                        <li class="list-group-item object-list-item" id="{{$object->placeId}}">
                            {{$object->name}}
                            <i class="bi bi-x-lg"></i>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <form class="search-form" action="/objects">
                        <div class="form-group">
                            <label for="name">Поиск по названию</label>
                            <input type="text" name="name" class="form-control" id="name"  placeholder="Введите название">
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <select class="form-control" id="city" name="city">
                                <option>
                                    Все
                                </option>
                                @foreach($cities as $city)
                                    <option>
                                        {{$city->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Найти</button>
                    </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <input id="objectName" type="text"/>
                </div>
                <div class="modal-footer">
                    <button id="modalClose" type="button" class="btn btn-secondary">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvxgcxq6qGtu16c5eqq2IJyf5P7AFvA3c&callback=initMap&libraries=places"></script>
    <script src="/js/map.js" type="text/javascript"></script>
@endsection
