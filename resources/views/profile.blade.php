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
        <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="text">{{$user->name}}&nbsp;{{$user->family}}</div>
                    <div class="text">Дата рождения: <span class="textBlack">{{$user->birth}}</span></div>
                    <div class="text">E-Mail: <span class="textBlack">{{$user->email}}</span></div>
                    <div class="text">Phone: <span class="textBlack">{{$user->phone}}</span></div>
                    <div class="text">
                        <span>Информация:</span><p class="textBlack">{{$user->information}}</p>
                    </div>
                    @if($user->id !== Auth::id())
                        <span class="text">
                            Съеден зомби
                        </span>
                        @csrf
                        <input type="hidden" id = "userId" value="{{$user->id}}" />
                        <input type="hidden" id="session" value="{{\Illuminate\Support\Facades\Session::token()}}" />
                        <input id="hit" type = "checkbox" {{$user->eat ? "checked" : "" }} />
                    @endif
                </div>
                <div class="col-md-6 text-right">
                @if($user->id !== Auth::id())
                        <a class="btn btn-primary" href="/message/{{$user->id}}">Написать сообщение</a>
                @else
                        <a class="btn btn-primary" href="{{route("editProfile")}}">Изменить данные</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" src="/js/main.js"></script>
@endsection
@include("includes.footer")
