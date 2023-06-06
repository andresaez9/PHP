<nav class="bg-gray-100">
    <div class="container mx-auto flex items-center justify-between py-4">
        <a class="text-gray-700 text-lg font-semibold" href="/"><span class="text-2xl">&#9820;</span> Videoclub</a>

        <button class="navbar-toggler md:hidden" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
            <div class="collapse navbar-collapse md:flex md:items-center" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('catalog') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link text-gray-700 hover:text-gray-900" href="{{url('/catalog')}}">
                            <span class="mr-2">&#128247;</span>
                            Catálogo
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('catalog/create') ? 'active' : ''}}">
                        <a class="nav-link text-gray-700 hover:text-gray-900" href="{{url('/catalog/create')}}">
                            <span class="mr-2">&#10010;</span> Nueva película
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form action="{{ url('/logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="bg-transparent text-gray-700 hover:text-gray-900 cursor-pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
