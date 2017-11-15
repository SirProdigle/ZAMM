@extends('layouts.master')

@section('content')

    <table class="table is-narrow">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Missions</th>
            <th>Reviews</th>
            @if(auth()->user()->IsRoleOrAbove('Super Admin'))
                <th>Latest IP</th>
            @endif
            <th>Delete User</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->missions()->count()}}</td>
                <td>{{$user->reviews()->count()}}</td>
                @if(auth()->user()->IsRoleOrAbove('Senior Admin'))
                    <td>@if($user->reviews()->count() > 0)
                        {{$user->reviews()->orderby('created_at','desc')->first()->ip}}</td>
                    @endif
                @else
                    0
                @endif
                <td><button class="button is-danger is-small" onclick="DeleteUserAjax({{$user->id}},this.parentElement)">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection





