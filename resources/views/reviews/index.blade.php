@extends('layouts.master')


@section('content')

    <section class="container">
        <h1 class="title has-text-primary">Review For: {{$mission->displayName}}</h1>

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
            <div class="container is-fluid">
                <button class=" button is-info"
                        onclick="window.location = '/bug/create/{{$mission->id}}'">
                    <span>Submit A Bug Report</span>
                    <span class="icon">
                            <i class="fa fa-check"></i>
                        </span>
                </button>
            </div>
            <form action="/review" method="post" onsubmit="return reviewIsOkay()">
                {{csrf_field()}}
                <input type="hidden" name="mission_id" value="{{$mission->id}}">


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Briefing</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="briefing">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="briefingDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">Detailed enough, listing all available assets and mission essential information to enable accurate pre-planning at briefing stage ?</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Equipment</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="equipment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="equipmentDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">Was your loadout and the overall equipment available to you sifficient to to achieve the mission objective. Did you need anything else</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Enemies</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="enemy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="enemyDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">Too many, too few ? Deployed correctly ? Difficult or easy to defeat ?</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Location</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="location">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="locationDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">Was the AO a good choice for this mission ? Was the terrain interesting enough and diverse enough ? Difficult or easy to defeat ? </p>
                        </div>
                    </div>
                </div>

                <hr>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Objectives</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="objectives">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="objectivesDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">Too many ? Too few ? Realistic ?Achievable ? </p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Overall Design</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="enjoyment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="enjoymentDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">What was good, bad about this mission, any opinions on how to improve it ? </p>
                        </div>
                    </div>
                </div>

                <hr>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Implementation</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="rating-box">
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,0)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,1)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,2)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,3)"></i>
                                    <i class="fa fa-star-o " onclick="UpdateStarRating(this.parentElement,4)"></i>
                                    <input type="hidden" name="competency">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="competencyDescription" placeholder="Add Optional Feedback Here"></textarea>
                            </div>
                            <p class="help">How well was this mission planned and managed by the group leaders and how did this effect your overall rating for the mission ? </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <button class="button is-primary">Submit Mission Feedback</button>
                            </p>
                        </div>
                    </div>
                </div>



            </form>
        </div>
    </section>



@endsection()