<nav class="navbar navbar-expand-lg myNav">
    <div class="container">
        <a class="navbar-brand" href={{ url('/1') }}>To Do List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (!auth()->id())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href={{ url("/User/create") }}>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href={{ url('/login') }}>Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href={{ url('/1') }}>My Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href={{ url('/Task/create') }}>Add Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href={{ url('/logOut') }}>Logout</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<body>
