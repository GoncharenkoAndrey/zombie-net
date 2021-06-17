@extends("layouts.master")
@section("title")
    Изменение пароля
@endsection
@section("content")
    <div class="row">
        <div class="col-md-12">
            <form action="{{route("passwordSave")}}" method="POST">
                <div class="form-group">
                    @csrf
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
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a class="btn btn-primary" href="{{route("dashboard")}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
