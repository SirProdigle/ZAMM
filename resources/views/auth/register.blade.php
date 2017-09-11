@extends('layouts.master')

@section('content')


    <div class="container">
        <h1 class="title has-text-primary">Register</h1>

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



    <form action="/register" method="post">
        {{csrf_field()}}

        <div class="field">
            <p class="control has-icons-left">
                <input class="input" name="name" placeholder="Username">
                <span class="icon is-small is-left">
                        <i class="fa fa-user"></i>
                    </span>

            </p>
        </div>

        <div class="field">
            <p class="control has-icons-left has-icons-right">
                <input class="input" type="email" placeholder="Email" name="email">
                <span class="icon is-small is-left">
                        <i class="fa fa-envelope"></i>
                    </span>
                <span class="icon is-small is-right">
                        <i class="fa fa-check"></i>
                    </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input" type="password" placeholder="Password" name="password">
                <span class="icon is-small is-left">
      <i class="fa fa-lock"></i>
    </span>
            </p>
        </div>
        <div class="field is-grouped-centered">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
            <div class="control">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </div>
        </div>
        <div class="field">
            <p class="control">
                <button class="button is-success">
                    Register
                </button>
            </p>
        </div>
    </form>
    </div>
@endsection
