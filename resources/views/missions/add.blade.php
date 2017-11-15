@extends('layouts.master')


@section('content')

    <div class="container">
        <section class="section">
            <h1 class="title is-spaced">Add A Mission In Your Name</h1>
            <p class="subtitle">
                This feature allows you to request a mission to be auto-assigned in your name when it is added to the
                server. Simply put in the FULL CORRECT filename of your mission and when it has been uploaded to the
                remote server, it will automatically be assigned to you. From that point you can set it's initial
                details.
            </p>


            <div class="notification is-warning">Soon the ability to set your missions default information on this page
                will be added
            </div>


            @if(Session::has('status-success'))
                <div class="notification is-success">
                    {{Session::get('status-success')}}
                </div>
            @endif
            @if(Session::has('status-danger'))
                <div class="notification is-danger">
                    @if(Session::get('status-danger') == 23000)
                        Someone Has Claimed This Mission File Name
                    @else
                        {{Session::get('status-danger')}}
                    @endif
                </div>
            @endif


        </section>
        <div class="box">
            <form action="/mission/add" method="post">
                {{csrf_field()}}

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Mission File Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input type="text" class="input" name="fileName">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <!-- Left empty for spacing -->
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


@endsection()