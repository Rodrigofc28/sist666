<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <p class="navbar-brand mr-1" >WEB ANUNCIOS</p>
   
</nav>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="dashbord" href="{{ route('dashboard') }}">
                <i class="fa fa-fw fa-home"></i>
                <span>VER ANUNCIOS</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="formulario" href="{{ route('laudos.create') }}">
                <i class="fa fa-fw fa-file"></i>
                <span>DIVULGAR</span>
                
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="formulario-inspecao" href="{{ route('laudos.formulario') }}">
            <i class="fa fa-fw fa-file"></i>
                <span>Formulario de inspeção</span></a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" id="logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out-alt"></i>
                <span>{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>