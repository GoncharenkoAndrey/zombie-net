@extends("layouts.master")
@section("title")
    Profile
@endsection
@section("content")
<div class="row">
    <div class="col-md-2">
        @include("menu")
    </div>
    <div class="col-md-10">
        <div>{{$user->name}}&nbsp;{{$user->family}}</div>
        <div>Дата рождения: {{$user->birth}}</div>
        <div>
            <span>Информация:</span><span>{{$user->information}}</span>
        </div>
        <span>
            Съеден
        </span>
        <input type = "checkbox" {{$user->eat ? checked : "" }} />
    </div>
</div>
@endsection
@include("includes.footer")
