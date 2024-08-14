<nav style="background-color: white !important;" class="navbar navbar-expand-lg bg-body-tertiary w-100">
    <div class="container-fluid d-flex">
        <a class="navbar-brand logo" href="{{ route('dashboard') }}">Whisper!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="header-sec collapse navbar-collapse" id="navbarNav">
            @guest()
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endguest
            @auth()
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <i class="fa fa-user-friends"></i>
                </button>
                <ul class="navbar-nav pe-5">
                    <li class="nav-item dropdown pe-5">
                        <button class="border-0 btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="border-0  dropdown-menu">
                            <li>
                                <a class="dropdown-item" aria-current="page" href="{{ route('profile.show', auth()->user()->username) }}">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" aria-current="page" href="{{ route('contact.index') }}">Contacts</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

@auth()
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Creat new group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <form action="{{ route('groups.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Four Fantastic ...">
                @error('name')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Add users
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @foreach(auth()->user()->contacts as $contact)
                                        <input name="{{ $contact->belongs->id }}" type="checkbox" class="btn-check" id="btn-check {{$contact->id}}" autocomplete="off">
                                        <label class="btn btn-outline-secondary mb-2" for="btn-check {{$contact->id}}">{{ $contact->name }}</label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="form-check form-switch mb-3">--}}
            {{--                <input class="form-check-input" type="checkbox" role="switch" name="publicGroup" id="publicGroup">--}}
            {{--                <label class="form-check-label" for="publicGroup">Make group public</label>--}}
            {{--            </div>--}}
            <button type="submit" class="btn btn-secondary">Create</button>
        </form>
    </div>
</div>
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="searchModallLabel">Search user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex" role="search" action="{{ route('search') }} " method="POST">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Username" aria-label="Search" name="q">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endauth
