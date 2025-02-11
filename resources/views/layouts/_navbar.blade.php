<div class="navbar">
    <div class="container-xl">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-heroicon-o-inbox-stack />
                    </span>
                    <span class="nav-link-title clamp_text_sm_3">
                        Inventario
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-heroicon-o-bookmark-square />
                    </span>
                    <span class="nav-link-title clamp_text_sm_3">
                        Categorías inventario
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('users_history.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-heroicon-o-calendar-days />
                    </span>
                    <span class="nav-link-title clamp_text_sm_3">
                        Historial cambios
                    </span>
                </a>
            </li>

            @can('navbar_auth')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-heroicon-o-shield-check />
                    </span>
                    <span class="nav-link-title clamp_text_sm_3">
                        Auth
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <div class="dropend">
                                <a class="dropdown-item clamp_text" href="{{ route('users.index') }}">
                                    <small>->&nbsp;</small>Usuarios
                                </a>
                                <a class="dropdown-item clamp_text" href="{{ route('roles.index') }}">
                                    <small>->&nbsp;</small>Roles
                                </a>
                                <a class="dropdown-item clamp_text" href="{{ route('permissions.index') }}">
                                    <small>->&nbsp;</small>Permisos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endcan
        </ul>
    </div>
</div>