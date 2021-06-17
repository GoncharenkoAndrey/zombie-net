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
            <ul class="list-group">
                @foreach($dialogs as $dialog)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/message/{{$dialog->user->id}}">{{$dialog->user->name}}&nbsp;{{$dialog->user->family}}</li>
                    </ul>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
