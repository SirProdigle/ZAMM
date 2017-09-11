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
                <a class="navbar-link  is-active">
                    Mission Listings
                </a>
                <div class="navbar-dropdown ">
                    <a class="navbar-item " href="/missions?server=0">
                        Zeus Main
                    </a>
                    <a class="navbar-item " href="/missions?server=1">
                        Zeus Addon
                    </a>
                    <a class="navbar-item " href="/user/{{auth()->id()}}/missions">
                        My Missions
                    </a>

                </div>
            </div>
            <a class="navbar-item">
                Add A Mission
            </a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link  is-active" href="/nations/{{auth()->id()}}">
                    Admin Panel
                </a>
                <div class="navbar-dropdown ">
                    <a class="navbar-item " href="/nations/{{auth()->id()}}/stats">
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


            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link  is-active" href="/internationalorganisations/description">
                    My Account
                </a>
                @if(!auth()->check())
                    <div class="navbar-dropdown ">
                        <a class="navbar-item " href="/password/reset">
                            Change Password
                        </a>
                    </div>
                @endif
            </div>
        </div>

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