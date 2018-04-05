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

        <div class="box">
            <form action="/mission/{{$mission->id}}" method="post">
                {{csrf_field()}}
                <div class="columns">
                    <div class="column is-1">
                        <h1 class="label margin-column text-center">Team</h1>
                        <h1 class="label">Friendly</h1>
                        <h1 class="label">Enemy</h1>
                    </div>
                    <div class="column">
                        <h1 class="label text-center margin-column">Orbat Type</h1>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="friendlyOrbatType"
                                       placeholder="Insert Custom"
                                       id="friendlyOrbatType" value="{{$mission->friendlyOrbatType}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <div class="control">
                                <div class="select is-small">
                                    <select name="" id=" " onchange="FillInBox('friendlyOrbatType',this)">
                                        <option value="" onclick="FillInBox('friendlyOrbatType','')">N/A</option>
                                        <option value="Spec Ops" onclick="FillInBox('friendlyOrbatType','SpecOps')">
                                            Spec Ops
                                        </option>
                                        <option value="Infantry" onclick="FillInBox('friendlyOrbatType','Infantry')">
                                            Infantry
                                        </option>
                                        <option value="Airborne" onclick="FillInBox('friendlyOrbatType','Airborne')">
                                            Airborne
                                        </option>
                                        <option value="Marines" onclick="FillInBox('friendlyOrbatType','Marines')">
                                            Marines
                                        </option>
                                        <option value="Motorised Infantry"
                                                onclick="FillInBox('friendlyOrbatType','Motorised')">Motorised
                                        </option>
                                        <option value="Mechanised Infantry"
                                                onclick="FillInBox('friendlyOrbatType','Mechanised Infantry')">
                                            Mechanised
                                            Infantry
                                        </option>
                                        <option value="Air Mobile Infantry"
                                                onclick="FillInBox('friendlyOrbatType','Air Mobile Infantry')">Air
                                            Mobile
                                        </option>
                                        <option value="Armoured" onclick="FillInBox('friendlyOrbatType','Armoured')">
                                            Armoured
                                        </option>
                                        <option value="Air" onclick="FillInBox('friendlyOrbatType','Air')">
                                            Air
                                        </option>
                                        <option value="Naval" onclick="FillInBox('friendlyOrbatType','Naval')">
                                            Naval
                                        </option>
                                        <option value="All Arms" onclick="FillInBox('friendlyOrbatType','All Arms')">All
                                            Arms
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="enemyOrbatType"
                                       placeholder="Insert Custom"
                                       id="enemyOrbatType" value="{{$mission->enemyOrbatType}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <div class="control">
                                <div class="select is-small">
                                    <select name="" id=" " onchange="FillInBox('enemyOrbatType',this)">
                                        <option value="" onclick="FillInBox('enemyOrbatType','')">N/A</option>
                                        <option value="Spec Ops" onclick="FillInBox('enemyOrbatType','SpecOps')">
                                            Spec Ops
                                        </option>
                                        <option value="Infantry" onclick="FillInBox('enemyOrbatType','Infantry')">
                                            Infantry
                                        </option>
                                        <option value="Airborne" onclick="FillInBox('enemyOrbatType','Airborne')">
                                            Airborne
                                        </option>
                                        <option value="Marines" onclick="FillInBox('enemyOrbatType','Marines')">
                                            Marines
                                        </option>
                                        <option value="Motorised Infantry"
                                                onclick="FillInBox('enemyOrbatType','Motorised')">Motorised
                                        </option>
                                        <option value="Mechanised Infantry"
                                                onclick="FillInBox('enemyOrbatType','Mechanised Infantry')">
                                            Mechanised
                                            Infantry
                                        </option>
                                        <option value="Air Mobile Infantry"
                                                onclick="FillInBox('enemyOrbatType','Air Mobile Infantry')">Air
                                            Mobile
                                        </option>
                                        <option value="Armoured" onclick="FillInBox('enemyOrbatType','Armoured')">
                                            Armoured
                                        </option>
                                        <option value="Air" onclick="FillInBox('enemyOrbatType','Air')">
                                            Air
                                        </option>
                                        <option value="Naval" onclick="FillInBox('enemyOrbatType','Naval')">
                                            Naval
                                        </option>
                                        <option value="All Arms" onclick="FillInBox('enemyOrbatType','All Arms')">
                                            All
                                            Arms
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <h1 class="label text-center margin-column">Support Assets</h1>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="friendlySupportAssets"
                                       placeholder="Insert Custom"
                                       id="friendlySupportAssets" value="{{$mission->friendlySupportAssets}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <p class="control">
                            <div class="select is-small">
                                <select name="" id=" " onchange="FillInBox('friendlySupportAssets',this)">
                                    <option value="" onclick="FillInBox('friendlySupportAssets','Infantry')">N/A
                                    </option>
                                    <option value="Mortars" onclick="FillInBox('friendlySupportAssets','Infantry')">
                                        Mortars
                                    </option>
                                    <option value="Artillery" onclick="FillInBox('friendlySupportAssets','Marines')">
                                        Artillery
                                    </option>
                                    <option value="CAS" onclick="FillInBox('friendlySupportAssets','Amphibious')">
                                        CAS
                                    </option>
                                </select>
                            </div>
                            </p>
                        </div>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="enemySupportAssets"
                                       placeholder="Insert Custom"
                                       id="enemySupportAssets" value="{{$mission->enemySupportAssets}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <p class="control">
                            <div class="select is-small">
                                <select name="" id=" " onchange="FillInBox('enemySupportAssets',this)">
                                    <option value="" onclick="FillInBox('enemySupportAssets','Infantry')">N/A</option>
                                    <option value="Mortars" onclick="FillInBox('enemySupportAssets','Infantry')">
                                        Mortars
                                    </option>
                                    <option value="Artillery" onclick="FillInBox('enemySupportAssets','Marines')">
                                        Artillery
                                    </option>
                                    <option value="CAS" onclick="FillInBox('enemySupportAssets','Marines')">CAS
                                    </option>
                                </select>
                            </div>
                            </p>
                        </div>
                    </div>

                    <div class="column">
                        <h1 class="label text-center margin-column">Faction</h1>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="friendlyFaction"
                                       placeholder="Insert Custom"
                                       id="friendlyFaction" value="{{$mission->friendlyFaction}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <p class="control">
                            <div class="select is-small">
                                <select name="" id=" " onchange="FillInBox('friendlyFaction',this)">
                                    <option value="" onclick="FillInBox('friendlyFaction','Infantry')">N/A</option>
                                    <option value="CSAT" onclick="FillInBox('friendlyFaction','Infantry')">
                                        CSAT
                                    </option>
                                    <option value="NATO" onclick="FillInBox('friendlyFaction','Infantry')">
                                        NATO
                                    </option>
                                    <option value="FIA" onclick="FillInBox('friendlyFaction','Infantry')">
                                        FIA
                                    </option>
                                    <option value="AAF" onclick="FillInBox('friendlyFaction','Infantry')">
                                        AAF
                                    </option>
                                    <option value="Warsaw Pact" onclick="FillInBox('friendlyFaction','Infantry')">
                                        Warsaw Pact
                                    </option>
                                    <option value="UK" onclick="FillInBox('friendlyFaction','Infantry')">
                                        UK
                                    </option>
                                    <option value="USMC" onclick="FillInBox('friendlyFaction','Infantry')">
                                        USMC
                                    </option>
                                    <option value="US Army" onclick="FillInBox('friendlyFaction','Infantry')">
                                        US Army
                                    </option>
                                    <option value="Insurgents" onclick="FillInBox('friendlyFaction','Infantry')">
                                        Insurgents
                                    </option>

                                </select>
                            </div>
                            </p>
                        </div>
                        <div class="field has-addons">
                            <p class="control  ">
                                <input class="input is-small" type="text" name="enemyFaction"
                                       placeholder="Insert Custom"
                                       id="enemyFaction" value="{{$mission->enemyFaction}}">
                            </p>
                            <p class="control">
                                <button class="button is-static is-small">Presets</button>
                            </p>
                            <p class="control">
                            <div class="select is-small">
                                <select name="" id=" " onchange="FillInBox('enemyFaction',this)">
                                    <option value="" onclick="FillInBox('enemyFaction','Infantry')">N/A</option>
                                    <option value="CSAT" onclick="FillInBox('enemyFaction','Infantry')">
                                        CSAT
                                    </option>
                                    <option value="NATO" onclick="FillInBox('enemyFaction','Infantry')">
                                        NATO
                                    </option>
                                    <option value="FIA" onclick="FillInBox('enemyFaction','Infantry')">
                                        FIA
                                    </option>
                                    <option value="AAF" onclick="FillInBox('enemyFaction','Infantry')">
                                        AAF
                                    </option>
                                    <option value="Warsaw Pact" onclick="FillInBox('enemyFaction','Infantry')">
                                        Warsaw Pact
                                    </option>
                                    <option value="UK" onclick="FillInBox('enemyFaction','Infantry')">
                                        UK
                                    </option>
                                    <option value="USMC" onclick="FillInBox('enemyFaction','Infantry')">
                                        USMC
                                    </option>
                                    <option value="US Army" onclick="FillInBox('enemyFaction','Infantry')">
                                        US Army
                                    </option>
                                    <option value="Insurgents" onclick="FillInBox('enemyFaction','Infantry')">
                                        Insurgents
                                    </option>

                                </select>
                            </div>
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
                                <textarea name="objectives" class="textarea" id="" cols="20"
                                          rows="2">{{$mission->objectives}}</textarea>
                            </p>
                        </div>
                    </div>
                </div> <!-- Objectives !-->
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Win/Lose Conditions</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <textarea name="winLoseConditions" class="textarea" id="" cols="20"
                                          rows="2">{{$mission->winLoseConditions}}</textarea>
                            </p>
                        </div>
                    </div>
                </div> <!-- Win/Lose !-->


                <!--Min Requirements!-->
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Minimum Requirements</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <textarea name="minimumRequirements" class="textarea" id="" cols="20"
                                          rows="2">{{$mission->minimumRequirements}}</textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <!--Min Players!-->
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Min Players</label>
                    </div>
                    <div class="field-body">
                        <div class="field has-addons">
                            <p class="control">
                                <input name="min" class="input" type="number" min="1" max="200"
                                       value="{{$mission->min}}">
                            </p>
                            <div class="control">
                                <button class="button is-static">Players</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Death Options!-->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Death Options</label>
                    </div>
                    <div class="field-body">
                        <div class="field has-addons">
                            <div class="control">
                                <button class="button is-static">Respawn?</button>
                            </div>
                            <div class="control">
                                <div class="select">
                                    <select name="respawn">
                                        <option {{$mission->respawn==0?"selected":""}} value="0">No</option>
                                        <option {{$mission->respawn==1?"selected":""}} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <div class="control">
                                <button class="button is-static">Revive?</button>
                            </div>
                            <div class="control">
                                <div class="select">
                                    <select name="respawn">
                                        <option {{$mission->respawn==0?"selected":""}} value="0">No</option>
                                        <option {{$mission->respawn==1?"selected":""}} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <div class="control">
                                <button class="button is-static">Bleed Out Time</button>
                            </div>
                            <div class="control ">
                                <input class="input is-success" name="bleedOut" type="number" placeholder="" min="0" max="999" value="{{$mission->bleedOut}}">
                            </div>
                            <div class="control">
                                <button class="button is-static">Seconds</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Who Revives! -->
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Who Can Revive </label>
                    </div>
                    <div class="field field-body">
                    <div class="field has-addons">

                        <p class="control  ">
                            <input class="input" type="text" name="whoCanRevive"
                                   placeholder="Insert Custom"
                                   id="whoCanRevive" value="{{$mission->whoCanRevive}}">
                        </p>
                        <p class="control">
                            <button class="button is-static">Presets</button>
                        </p>
                        <div class="control">
                            <div class="select ">
                                <select name="" id=" " onchange="FillInBox('whoCanRevive',this)">
                                    <option value="" onclick="FillInBox('whoCanRevive','Infantry')">N/A</option>
                                    <option value="No Revive" onclick="FillInBox('whoCanRevive','Infantry')">No Revive
                                    </option>
                                    <option value="Medic" onclick="FillInBox('whoCanRevive','Infantry')">
                                        Medic
                                    </option>
                                    <option value="Anyone With Medkit" onclick="FillInBox('whoCanRevive','Marines')">Anyone With
                                        Medkit
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


                <!-- Misc !-->
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Misc Notes</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <textarea name="misc" class="textarea" id="" cols="20"
                                          rows="2">{{$mission->misc}}</textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Button !-->
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
    </div>


@endsection