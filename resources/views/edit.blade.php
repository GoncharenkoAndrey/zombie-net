@extends("layouts.master")
@section("title")
    Изменение данных профиля
@endsection
@section("content")
    <div class="row">
        <div class="col-md-9">
            <h3>Изменеие профиля</h3>
            <form action="{{route("profileSave")}}" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="_token" value="{{\Illuminate\Support\Facades\Session::token()}}" />
                    <div class="form-group">
                        <label for="login">Имя для входа</label>
                        <input class="form-control" type="text" id="login" name="login" value="{{$user->login}}" placeholder="Имя для входа">
                        @error('login')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="Имя">
                        <p class="nameError"></p>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="family">Фамилия</label>
                        <input class="form-control" type="text" id="family" name="family" value="{{$user->family}}" placeholder="Фамилия">
                        @error('family')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Электронная почта</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{$user->email}}" placeholder="Электронная почта">
                        @error("email")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input class="form-control" type="text" id="phone" name="phone" value="{{$user->phone}}" placeholder="Телефон">
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth">Дата рождения</label>
                        <input class="form-control" type="date" id="birth" name="birth" value="{{$user->birth}}" placeholder="Дата рождения">
                        @error('date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Фото</label>
                        <input class="form-control" type="file" id="photo" name="photo" value="{{$user->photo}}" placeholder="Фото" />
                    </div>
                    <div class="form-group">
                        <label for="information">Дополнительная информация</label>
                        <textarea class="form-control" id="information" name="information" placeholder="Дополнительная информация">{{$user->information}}</textarea>
                    </div>
                    <input type="hidden" id="location" name="locationId" value="{{$user->locationId}}" />
                    <input type="hidden" id="city" name="city" value="{{$user->city}}" />
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a class="btn btn-primary" href="{{route("dashboard")}}">Отмена</a>
                    <a class="btn btn-primary" href="{{route("changePassword")}}">Изменить пароль</a>
                </div>
            </form>
        </div>
        <div id="userMap" class="userMap col-md-3"></div>
    </div>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvxgcxq6qGtu16c5eqq2IJyf5P7AFvA3c&callback=initMap&libraries=places"></script>
    <script src="/js/editMap.js"></script>
@endsection
