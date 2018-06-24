<!-- ACTUAL NAVBAR STARTS HERE !-->

<nav class="navbar ">
    <div class="navbar-brand">
        <a class="navbar-item has-text-info" href="/">
            <span> Zeus Mission Manager </span>
        </a>

        <a class="navbar-item is-hidden-desktop" href="https://github.com/sirprodigle/Zeus-Mission-Manager"
           target="_blank">
      <span class="icon" style="color: #333;">
        <i class="fa fa-github"></i>
      </span>
        </a>


        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link  is-active is-unselectable">
                    Mission Listings
                </div>
                <div class="navbar-dropdown ">
                    <a class="navbar-item " href="/missions?server=0">
                        Zeus #1 Vanilla
                    </a>
                    <a class="navbar-item " href="/missions?server=1">
                        Zeus #2 Addon
                    </a>
                    <a class="navbar-item " href="/missions?server=2">
                        Zeus #3 Spec Ops
                    </a>
                    <a class="navbar-item " href="/missions?server=3">
                        Zeus #4 Special Events
                    </a>
                    <a class="navbar-item " href="/missions?server=4">
                        Zeus #1 Test
                    </a>
                    <a class="navbar-item " href="/missions?server=5">
                        Zeus #2 Test
                    </a>
                    <a class="navbar-item " href="/user/{{auth()->id()}}/missions">
                        My Missions
                    </a>

                </div>
            </div>
            <a class="navbar-item" href="/mission/add">
                Add A Mission
            </a>
            <div class="navbar-item has-dropdown is-hoverable is-unselectable">
                <div class="navbar-link  is-active">
                    Admin Panel
                </div>
                <div class="navbar-dropdown ">
                    <a class="navbar-item " href="/users">
                        User Management
                    </a>
                    <a class="navbar-item " href="/nations/{{auth()->id()}}/messages/">
                        Pending Requests
                    </a>
                    <a class="navbar-item " href="/nations/{{auth()->id()}}/messages/">
                        Logs
                    </a>

                </div>
            </div>
        @if(!auth()->check())
                <a class="navbar-item " href="/password/reset">
                    Forgot/Reset Password
                </a>
        @endif

        <div class="navbar-end">

            <div class="navbar-item">
                <div class="field is-grouped">
                    @if(!auth()->check())
                        <p class="control">
                            <a class="button is-success" href="/register">
                            <span class="icon">
                            <i class="fa fa-user-plus"></i>
                            </span>
                                <span>Register</span>
                            </a>
                        </p>
                        <p class="control">
                            <a class="button is-success" href="/login">
                            <span class="icon">
                            <i class="fa fa-user"></i>
                            </span>
                                <span>Login</span>
                            </a>
                        </p>
                    @else
                        <p class="control">
                            <a class="button is-success" href="/logout">
                            <span class="icon">
                            <i class="fa fa-user"></i>
                            </span>
                                <span>Logout {{auth()->user()->name}}</span>
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav></nav>