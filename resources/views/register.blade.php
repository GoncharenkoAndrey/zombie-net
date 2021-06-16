@extends("layouts.master")
@section("title")
    Welcome!
@endsection
@section("content")
    <div class="row">
        <div class="col-md-12">
            <h3>Регистрация</h3>
            <form action="/register" method="POST">
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="_token" value="{{\Illuminate\Support\Facades\Session::token()}}" />
                    <div class="form-group">
                        <label for="login">Имя для входа</label>
                        <input class="form-control" type="text" id="login" name="login" placeholder="Имя для входа">
                        @error('login')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Пароль">
                        @error("password")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Повтор пароля</label>
                        <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Повтор пароля">
                        @error("passwordConfirm")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input class="form-control" type="text" name="name" placeholder="Имя">
                        <p class="nameError"></p>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="family">Фамилия</label>
                        <input class="form-control" type="text" id="family" name="family" placeholder="Фамилия">
                        @error('family')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Электронная почта</label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="Электронная почта">
                        @error("email")
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input class="form-control" type="text" id="phone" name="phone" placeholder="Телефон">
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth">Дата рождения</label>
                        <input class="form-control" type="date" id="birth" name="birth" placeholder="Дата рождения">
                        @error('date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="information">Дополнительная информация</label>
                        <textarea class="form-control" id="information" name="information" placeholder="Дополнительная информация"></textarea>
                    </div>
                    <button type="submit" class="button button-primary">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
@endsection

