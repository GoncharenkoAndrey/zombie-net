@extends("layouts.master")
@section("title")
    Сообщения
@endsection
@section("content")
    <div class="row h-100">
        <div class="col-md-2">
            @include("menu")
        </div>
        <div class="h-100 col-md-10">
            <div class="messages">
                @foreach($messages as $message)
                    @if($message->fromId !== Auth::id())
                        <p class="text-right">
                            {{$message->user->name}} {{$message->user->family}}
                        </p>
                        <p  class="text-right">
                            {{$message->content}}
                        </p>
                    @else
                        <p>
                            {{Auth::user()->name}} {{Auth::user()->family}}
                        </p>
                        <p>
                            {{$message->content}}
                        </p>
                    @endif
                @endforeach
            </div>
            <form class="messageForm" action="{{route("messageSend", $id)}}" method="POST">
                @csrf
                <textarea class="col-md-12" name="message"></textarea>
                <button class="btn btn-primary" type="submit">Отправить</button>
            </form>
        </div>
    </div>
@endsection
