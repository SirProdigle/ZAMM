@extends('layouts.master')

@section('content')
    <div class="container is-fluid">
        <button class=" button is-info"
                onclick="window.location = '/bug/create/{{$mission->id}}'">
            <span>Submit A Bug Report</span>
                        <span class="icon">
                            <i class="fa fa-check"></i>
                        </span>
        </button>
    </div>
    <table class="table is-narrow">
        <thead>
        <tr>
            <th>Description</th>
            <th>Complete</th>
            @if(auth()->user()->IsRoleOrAbove('Super Admin'))
                <th>Submitted By</th>
            @endif
        </tr>
        </thead>

        <tbody>
        @foreach ($bugs as $bug)
            <tr id="{{$bug->id}}">
                <td>{{$bug->description}}</td>
                <td>
                    <button class=" button is-success is-small"
                            onclick="DeleteBug(this.parentElement.parentElement.id,this.parentElement.parentElement)">
                        <span class="icon">
                            <i class="fa fa-check"></i>
                        </span>
                    </button>
                </td>
                <td>{{$bug->user->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection





