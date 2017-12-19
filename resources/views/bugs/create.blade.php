@extends('layouts.master')
@section('content')
    <div class="container">
        <h1 class="title has-text-primary">Submit Bug For {{$mission->displayName}}</h1>

        @if ($errors->any())
            <div class="notification is-danger">
                <button class="delete"></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <form action="/bug/create" method="post">
            {{csrf_field()}}
            <div class="field">
                <label class="label">Mission ID</label>
                <div class="control">
                    <input class="input" type="text" placeholder="" name="mission_id" value="{{$mission->id}}" readonly>
                </div>
            </div>
            <div class="field">
                <label class="label">Bug Description</label>
                <div class="control">
                    <textarea class="textarea" name="description"
                              placeholder="What is the bug? Lengthy detail is useful"></textarea>
                </div>
            </div>

            <div class="field">
                <p class="control">
                    <button class="button is-success">
                        Submit Bug
                    </button>
                </p>
            </div>
        </form>
    </div>
@endsection