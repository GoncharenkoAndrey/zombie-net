@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-md-2">
        @include("menu")
        </div>
        <div class="col-md-10">
        <form class="search-form" action="/users">
            <div class="form-group">
                <label for="name">Поиск по имени</label>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" name="email" class="form-control" id="email"  placeholder="Введите email">
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
        <div class="users-list">
            @if(count($users) == 0)
                Пользователи по запросу не найдены
            @endif
            @foreach($users as $user)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/user/{{$user->id}}">{{$user->name}}&nbsp;{{$user->family}}</li>
                    </ul>
            @endforeach
        </div>
        </div>
            <div class="float-clear"> </div>
    </div>
@endsection
@include("includes.footer")
