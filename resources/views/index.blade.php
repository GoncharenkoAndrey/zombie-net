@extends("layouts.master")
@section("title")
    Welcome!
@endsection
@section("content")
    <div class="row">
        <div class="col-md-12">
            <h3>Вход</h3>
            <form action="/login" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{\Illuminate\Support\Facades\Session::token()}}" />
                <div class="form-group">
                    <label for="email">Электронная почта</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="Электронная почта">
                    @error("email")
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
                <button class="button button-primary">Войти</button>
                <div class="text-center p-t-12">
                    <a href="/restore">Забыли пароль?</a>
                </div>
                <div class="text-center p-b-136">
                    <a href="/register">Регистрация</a>
                </div>
            </form>
        </div>
    </div>
@endsection
