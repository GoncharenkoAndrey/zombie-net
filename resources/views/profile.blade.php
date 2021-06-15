@include("header")
<div class="page">
    <div class="column1">
        @include("menu")
    </div>
    <div class="column2">
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
@include("footer")
