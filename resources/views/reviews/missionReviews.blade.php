@extends('layouts.master')


@section('content')

    <div class="container">
        <h1 class="title has-text-primary has-text-centered">{{$mission->displayName}}</h1>
    </div>





    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Briefing</p>
                <p class="title">{{number_format($mission->reviews()->avg('briefing'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Equipment</p>
                <p class="title">{{number_format($mission->reviews()->avg('equipment'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Enemy</p>
                <p class="title">{{number_format($mission->reviews()->avg('enemy'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Location</p>
                <p class="title">{{number_format($mission->reviews()->avg('location'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Objectives</p>
                <p class="title">{{number_format($mission->reviews()->avg('objectives'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Enjoyment</p>
                <p class="title">{{number_format($mission->reviews()->avg('enjoyment'),1)}}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Overall</p>
                <p class="title">{{number_format($mission->GetOverallScore(),1)}}</p>
            </div>
        </div>
    </div>


    @foreach($mission->reviews as $review)
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
                            <div class="title">Enjoyment</div>
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





@endsection()