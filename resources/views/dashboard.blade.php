@extends("layouts.master")
<div class="row">
    <div class="col-md-6">
        @include("menu")
    </div>
    <div class="col-md-6">
        {{$user->name}}
        {{$user->family}}
        {{$user->email}}
    </div>
</div>
