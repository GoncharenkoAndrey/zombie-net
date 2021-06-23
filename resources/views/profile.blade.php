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
                    <div class="row rightColumn">
                                <div class="userData col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img class="photo" alt="photo" src="photos/{{$user->photo}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            @if($user->id !== Auth::id())
                                                <a class="btn btn-primary" href="/message/{{$user->id}}">Написать
                                                    сообщение</a>
                                            @else
                                                <a class="btn btn-primary" href="{{route("editProfile")}}">Изменить
                                                    данные</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text">{{$user->name}}&nbsp;{{$user->family}}</div>
                                    <div class="text">Дата рождения: <span class="textBlack">{{$user->birth}}</span>
                                    </div>
                                    <div class="text">E-Mail: <span class="textBlack">{{$user->email}}</span></div>
                                    <div class="text">Phone: <span class="textBlack">{{$user->phone}}</span></div>
                                    <div class="text">
                                        <span>Информация:</span>
                                        <p class="textBlack">{{$user->information}}</p>
                                    </div>
                                    <input type="hidden" id="userId" value="{{$user->id}}"/>
                                    <input type="hidden" id="location" name="location" value="{{$user->locationId}}"/>
                                    <input type="hidden" id="session"
                                           value="{{\Illuminate\Support\Facades\Session::token()}}"/>
                                    @if($user->id !== Auth::id())
                                        <span class="text">
                                            Съеден зомби
                                        </span>
                                        @csrf
                                        <input id="hit" type="checkbox" {{$user->eat ? "checked" : "" }} />
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <div id="userMap" class="userMap"></div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <script async
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvxgcxq6qGtu16c5eqq2IJyf5P7AFvA3c&callback=initMap&libraries=places"></script>
        <script src="/js/userMap.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
@endsection
@include("includes.footer")
