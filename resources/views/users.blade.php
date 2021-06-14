@include("header")
<div class="container">
    <div class="row align-items-start">
    @include("menu")
        <div class="col-8">
            @foreach($users as $user)
                <ul>
                    <li class="user">
                        <a href = "/users/{{$user->id}}">
                            {{$user->name}}
                            {{$user->family}}
                        </a>
                        <input type = "checkbox" {{$user->eat ? checked : "" }} />
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
@include("footer")
