@extends('layouts.master')


@section('content')

    <div class="container">
        <h1 class="title has-text-primary">Update Data For: {{$mission->displayName}}</h1>

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


        <form action="/mission/{{$mission->id}}" method="post">
            {{csrf_field()}}

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Respawn</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <div class="select">
                                <select name="respawn">
                                    <option {{$mission->respawn==0?"selected":""}} value="0">No</option>
                                    <option {{$mission->respawn==1?"selected":""}} value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Orbital Type</label>
                </div>
                <div class="field-body">
                    <div class="field is-expanded">
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input" type="text" name="orbitalType" placeholder="Insert Custom Here" value="{{$mission->orbitalType}}">
                            </p>
                            <p class="control">
                                <button class="button is-static">Presets:</button>
                            </p>
                            <p class="control">
                            <div class="select">
                                <select name="" id="">
                                    <option value="">MAKE THESE INPUT JS INTO THE TEXT CONTROL BELOW</option>
                                    <option value="">Artillery</option>
                                    <option value="">Air CAS</option>
                                </select>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Support Assets</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea name="supportAssets" class="textarea" id="" cols="20" rows="2">{{$mission->supportAssets}}</textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Minimum Requirements</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea name="minimumRequirements" class="textarea" id="" cols="20" rows="2">{{$mission->minimumRequirements}}</textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Objectives</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea name="objectives" class="textarea" id="" cols="20" rows="2">{{$mission->objectives}}</textarea>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Bleed Out</label>
                </div>
                <div class="field-body">
                    <div class="field has-addons">
                        <p class="control">
                            <input name="bleedOut" class="input" type="number" min="0" max="900" value="{{$mission->bleedOut}}">
                        </p>
                        <div class="control">
                            <button class="button is-static">Seconds</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Revive</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                        <div class="select">
                            <select name="revive" id="">
                                <option {{$mission->revive==0?"selected":""}} value="0">No</option>
                                <option {{$mission->revive==1?"selected":""}} value="1">Yes</option>
                            </select>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Win/Lose Conditions</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea name="winLoseConditions" class="textarea" id="" cols="20" rows="2">{{$mission->winLoseConditions}}</textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Misc Notes</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea name="notes" class="textarea" id="" cols="20" rows="2">{{$mission->notes}}</textarea>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <button class="button is-primary">Update Mission Data</button>
                        </p>
                    </div>
                </div>
            </div>


        </form>
    </div>


@endsection