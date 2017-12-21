@extends('layouts.master')
@section('content')

    <table class="table is-narrow is-fullwidth is-striped">
        <thead>
        <tr>
            <th onclick="FilterBy('Status')"><a href="#">Status</a></th>
            <th onclick="FilterBy('GameType')"><a href="#">Game Type</a></th>
            <th onclick="FilterBy('Max')"><a href="#">Min</a></th>
            <th onclick="FilterBy('Max')"><a href="#">Max</a></th>
            <th onclick="FilterBy('MissionName')"><a href="#">Mission Name</a></th>
            <th onclick="FilterBy('Author')"><a href="#">Author</a></th>
            <th onclick="FilterBy('LastPlayed')"><a href="#">Last Played</a></th>
            <th>Completed</th>
            <th onclick="FilterBy('Bugs')"><a href="#">Bugs</a></th>
            <th onclick="sortTable(8)"><a href="#">Rating</a></th>
            <th><a href="#">Feedback</a></th>
            <th onclick="FilterBy('LastUpdated')"><a href="#">Last Updated</a></th>
            <th onclick="FilterBy('Notes')"><a href="#">Notes</a></th>
            <th>Review Link</th>
            <th>Save</th>
            @if(auth()->check() && auth()->user()->IsRoleOrAbove('Game Admin'))
                <th>Move</th>
            @endif
            @if(auth()->check() && auth()->user()->IsRoleOrAbove('Game Admin'))
                <th>Delete</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($missionList as $mission)
            <tr id="{{$mission->id}}">
                <td>
                    <select name="status"
                            @switch($mission->status)
                            @case('Online')
                            {{"class=is-online"}}
                            @break
                            @case('Updated')
                            {{"class=is-updated"}}
                            @break
                            @case('New')
                            {{"class=is-new"}}
                            @break
                            @case('Broken')
                            {{"class=is-broken"}}
                            @break
                            @case('Pending Details')
                            {{"class=is-pending"}}
                            @break
                            @endswitch
                            {{$disabled==true?'disabled':''}} onchange="UpdateRow(this.parentElement.parentElement); AddStatusClass(this.value,this)">
                        <option class="is-online" {{$mission->status == 'Online'? 'selected':''}}>Online</option>
                        <option class="is-updated" {{$mission->status == 'Updated'? 'selected':''}}>Updated</option>
                        <option class="is-new" {{$mission->status == 'New'? 'selected':''}}>New</option>
                        <option class="is-broken" {{$mission->status == 'Broken'? 'selected':''}}>Broken</option>
                        <option class="is-pending" {{$mission->status == 'Pending Details'? 'selected':''}}>Pending
                            Details
                        </option>
                    </select>
                </td>
                <td>{{$mission->gameType}}</td>
                <td>
                    <input onchange="UpdateRow(this.parentElement.parentElement)"
                           {{$disabled==true?'disabled':''}} type="number" value="{{$mission->min}}" min="0" max="200">
                </td>
                <td>{{$mission->max}}</td>
                <td><a href="/mission/{{$mission->id}}">{{$mission->displayName}}</a></td>
                <td><select name="user_id"
                            onchange="UpdateRow(this.parentElement.parentElement)" {{$disabled==true?'disabled':''}}>
                        <option {{$mission->user_id == null? 'selected':''}}>???</option>
                        @foreach($authorList as $author)
                            <option value="{{$author->id}}" {{$mission->user_id == $author->id? 'selected':''}}>{{$author->name}}</option>
                        @endforeach

                    </select></td>

                <td>
                    <input onchange="UpdateRow(this.parentElement.parentElement)"
                           {{$disabled==true?'disabled':''}} type="date"
                           value="{{date("Y-m-d", strtotime($mission->lastPlayed)) }}">
                </td>
                <td><select {{$disabled==true?'disabled':''}} onchange="UpdateRow(this.parentElement.parentElement)"
                            name="completed" id="">
                        <option {{$mission->completed == 1? 'selected':''}} value="1">Yes</option>
                        <option value="0" {{$mission->completed == 0? 'selected':''}}>No</option>
                    </select></td>
                <td class="text-center"><a href="/mission/{{$mission->id}}/bugs">{{$mission->bugs->count()}}</a></td>
                <td class="text-center"><a
                            href="/mission/{{$mission->id}}/reviews">{{number_format($mission->GetOverallScore(),1) }}</a>
                </td>
                <td class="text-center"><a href="/mission/{{$mission->id}}/reviews">{{$mission->reviews->count()}}</a>
                </td>
                <td>
                    {{date("Y-m-d", strtotime($mission->lastUpdated)) }}
                </td>
                <td><input onchange="UpdateRow(this.parentElement.parentElement)" type="text"
                           value="{{$mission->notes}}"></td>
                <td><a href="/review/{{$mission->id}}">Review</a></td>

                <td class="is-centered">
                    <button class=" button is-info is-small"
                            onclick="document.location ='/mission/{{$mission->id}}/download'">
                        <span class="icon">
                            <i class="fa fa-save"></i>
                        </span>
                    </button>
                </td>
                @if(auth()->check() && auth()->user()->IsRoleOrAbove('Game Admin'))
                    <td>
                        <button class=" button is-primary is-small"
                                onclick="MoveMissionShowBox(this.parentElement.parentElement);">
                        <span class="icon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        </button>
                    </td>
                @endif
                @if(auth()->check() && auth()->user()->IsRoleOrAbove('Game Admin'))
                    <td>
                        <button class=" button is-danger is-small"
                                onclick="DeleteMission(this.parentElement.parentElement.id,this.parentElement.parentElement)">
                        <span class="icon">
                            <i class="fa fa-close"></i>
                        </span>
                        </button>
                    </td>
                @endif


            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- MODAL FOR MOVING FILE !-->
    <div class="modal" id="moveMissionModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Move Mission</p>
                <button class="delete" aria-label="close" onclick="MoveMissionCloseBox()"></button>
            </header>
            <section class="modal-card-body">
                <p id="move-message">Mission Y is currently in server z </p>
                <div class="field">
                    <label class="label">Move To Server</label>
                    <div class="control">
                        <select id="moveMissionServer">
                            <option value="0"> Zeus #1</option>
                            <option value="1"> Zeus #2</option>
                            <option value="2"> Zeus #3</option>
                            <option value="3"> Zeus #4</option>
                            <option value="4"> Zeus Test #1</option>
                            <option value="5"> Zeus Test #2</option>
                        </select>
                        <input type="hidden" id="moveMissionID" value="">
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" onclick="MoveMission(document.getElementById('moveMissionID').innerText,document.getElementById('moveMissionServer').value)">Move File</button>
                <button class="button" onclick="MoveMissionCloseBox()">Cancel</button>
            </footer>
        </div>
    </div>


@endsection