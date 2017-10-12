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
            <form action="/review" method="post">
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
                        <label class="label">Briefing Message</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="briefingDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
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
                        <label class="label">Equipment Message</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="equipmentDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
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
                        <label class="label">Enemies Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="enemyDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
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
                        <label class="label">Location Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="locationDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
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
                        <label class="label">Objectives Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="objectivesDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Enjoyment</label>
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
                        <label class="label">Enjoyment Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="enjoymentDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
                        </div>
                    </div>
                </div>

                <hr>


                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Player Competency</label>
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
                        <label class="label">Competency Description</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="competencyDescription" placeholder="A message is optional. Refer to the help text below"></textarea>
                            </div>
                            <p class="help">You should include information about if the briefing contained enough information to play out the mission well</p>
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