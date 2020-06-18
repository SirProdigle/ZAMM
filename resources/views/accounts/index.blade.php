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
			<tr id="{{ $user->id }}">
            <a id="{{ $user->id }}">
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> @if (!auth()->user()->IsAboveRole($user->role))
                        {{$user->role}}
                    @else
                    <select onchange="ChangeUserRoleAjax(this.parentElement.parentElement.id,this.value)">
                        @foreach($finalRoles as $role)
                            <option @if($role == $user->role){{"selected"}} @endif>{{$role}}</option>
                            @endforeach
                    </select>
                    @endif
                </td>
                <td><a href="/user/{{$user->id}}/missions">{{$user->missions()->count()}}</a></td>
                <td><a href="/users/{{$user->id}}/reviews"> {{$user->reviews()->count()}}</a></td>
                @if(auth()->user()->IsRoleOrAbove('Senior Admin'))
                    <td> @if($user->reviews()->count() > 0)
                            {{$user->reviews()->orderby('created_at','desc')->first()->ip}}</td>
                @endif
                @else
                    0
                @endif
            </a>
                <td>
                    <button class="button is-danger is-small"
                            onclick="DeleteUserAjax( {{$user->id}} ,this.parentElement)">Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection





