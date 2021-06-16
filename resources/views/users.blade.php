@extends("layouts.master")
    <div class="row">
        <div class="col-md-2">
        @include("menu")
        </div>
        <div class="col-md-10">
        <form class="search-form" action="/users">
            <div class="form-group">
                <label for="name">Search by name</label>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="email">Search by email</label>
                <input type="text" name="email" class="form-control" id="email"  placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
@include("includes.footer")
