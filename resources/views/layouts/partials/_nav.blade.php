<div class="navbar-fixed">
    <nav class="blue-grey darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo text-capitalize">
                {{ config('app.name') }}
            </a>

            <!-- Full width menu -->
            <ul class="right hide-on-med-and-down">
                <li class="{{ ifRoute('invoices', 'active') }}">
                    <a href="{{ route('invoices') }}">Invoices</a>
                </li>
                <li class="{{ ifRoute('projects', 'active') }}">
                    <a href="{{ route('projects') }}">Projects</a>
                </li>
                <li><a href="#">Estimates</a></li>
                <li><a href="#">Recurrings</a></li>
                <li class="{{ ifRoute('clients', 'active') }}">
                    <a href="{{ route('clients') }}">Clients</a>
                </li>
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="menu-user">
                        {{ getAuthUser()->name }}<i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="menu-user" class="dropdown-content">
                        <li><a href="#!">Profile</a></li>
                        <li><a href="#!">Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="#!">LogOut</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Mobile menu -->
            <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Invoices</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Estimates</a></li>
                <li><a href="#">Recurrings</a></li>
                <li><a href="#">Clients</a></li>
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="menu-user-m">
                        User Name<i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="menu-user-m" class="dropdown-content">
                        <li><a href="#!">Profile</a></li>
                        <li><a href="#!">Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="#!">LogOut</a></li>
                    </ul>
                </li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </nav>
</div>
