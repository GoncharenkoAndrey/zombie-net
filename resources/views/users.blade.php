@include("header")
    <div class="page">
        <div class="column1">
        @include("menu")
        </div>
        <div class="column2">
        <form class="search-form" action="/userslist">
            <div class="form-group">
                <label for="name">Search by name</label>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="email">Search by email</label>
                <input type="text" name="email" class="form-control" id="email"  placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="users-list">
            @foreach($users as $user)
                <ul>
                    <li class="user">
                        <a href = "/users/{{$user->id}}">
                            {{$user->name}}
                            {{$user->family}}
                        </a>
                    </li>
                </ul>
            @endforeach
        </div>
        </div>
            <div class="float-clear"> </div>
    </div>
@include("footer")
