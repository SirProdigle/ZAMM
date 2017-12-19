@extends('layouts.master')


@section('content')

    <section class="container">
        <h1 class="title has-text-primary">User Review For: {{$user->name}}</h1>

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
            @foreach($user->reviews as $review)
                @if($review->IsTextReview())
                    <div class="container">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    {{$review->created_at}}
                                    @if(auth()->user()->IsRoleOrAbove('Game Admin'))
                                        {{" | " . $review->ip }}
                                        @if(isset($review->user))
                                            {{" | " .$review->user->name}}
                                        @endif
                                    @endif
                                    {{" | " . $review->mission->displayName}}
                                </p>
                                <div class="card-header-icon" aria-label="more options">
                                    Version: {{$review->missionVersion}}
                                </div>
                            </header>
                            <div class="card-content">
                                <div class="columns">
                                    <div class="column is-11">
                                        <div class="title">Briefing</div>
                                        {{$review->briefingDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->briefing}}</div>
                                </div>
                                <hr>
                                <div class="columns">
                                    <div class="column is-11">
                                        <div class="title">Equipment</div>
                                        {{$review->equipmentDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->equipment}}</div>
                                </div>
                                <hr>
                                <div class="columns">
                                    <div class="column is-11">
                                        <div class="title">Enemy</div>
                                        {{$review->enemyDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->enemy}}</div>

                                </div>
                                <hr>
                                <div class="columns">
                                    <div class="column is-11">
                                        <div class="title">Location</div>
                                        {{$review->locationDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->location}}</div>

                                </div>
                                <hr>
                                <div class="columns">
                                    <div class="column is-11">
                                        <div class="title">Objectives</div>
                                        {{$review->objectivesDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->objectives}}</div>

                                </div>
                                <hr>
                                <div class="columns">
                                    <div class="column is-111">
                                        <div class="title">Design</div>
                                        {{$review->enjoymentDescription}}
                                    </div>
                                    <div class="column is-1 title">{{$review->enjoyment}}</div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
    </section>



@endsection()