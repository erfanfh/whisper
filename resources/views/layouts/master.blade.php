@include('layouts.header')

<header class="main-navbar navbar sticky-top bg-light flex-md-nowrap p-0 shadow" data-bs-theme="light">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-dark" href="{{ route('dashboard') }}">
        <img width="50" src="{{ asset('Images/Logo/svg/logo-no-background.svg') }}" alt="">
    </a>

    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
            </button>
        </li>
    </ul>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-3 p-0">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">Whisper!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <div class="" id="accordionUser">
                        <div class="accordion-item collapsed px-2">
                            <h2 class="accordion-header">
                                <button class="pb-3 accordion-button dropdown-toggle" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <img src="{{ asset('Images/Profiles') . "/" . auth()->user()->profile->image }}" alt="profile photo" width="32"
                                         height="32" class="rounded-circle me-2">
                                    <strong>{{ auth()->user()->name }}</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionUser">
                                <div class="accordion-body">
                                    <ul class="list-group mt-2">
                                        <li class="list-group-item list-group-item-action bg-transparent border-0">
                                            <button type="button" class="btn text-dark p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                                                Search user
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                                </svg>
                                            </button>
                                        </li>
                                        <li class="list-group-item list-group-item-action bg-transparent border-0">
                                            <a href="{{ route('profile.show', auth()->user()->username) }}"
                                               class="text-dark">Profile</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-dark bg-transparent border-0">
                                            <a href="{{ route('contact.index') }}" class="text-dark">Contacts</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-dark bg-transparent border-0">
                                            <button class="btn text-dark p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#createGroupOffcanvas" aria-controls="createGroupOffcanvas">
                                                Create new Group
                                            </button>
                                        </li>
                                        <hr>
                                        <li class="list-group-item list-group-item-action list-group-item-dark bg-transparent border-0">
                                            <a href="{{ route('logout') }}" class="text-dark">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-pills flex-column mb-auto bg-light">
                        <li class="px-3 mt-3">
                            <div class="text-secondary fw-bold font-monospace">Conversations</div>
                        </li>
                        <li class="border-bottom px-3 border-dark-subtle">
                            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active py-3 lh-tight" aria-current="true">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">GLOBAL <i class="fa fa-earth"></i> </strong>
                                </div>
                            </a>
                        </li>
                        @foreach(auth()->user()->groups as $group)
                            <li class="border-bottom px-3 border-dark-subtle">
                                <a href="{{ route('groups.show', ['group' => $group->id]) }}" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <strong class="mb-1">{{ $group->name }}</strong>
                                        <small>{{ $group->posts->last() ? $group->posts->last()->created_at->format("Y/m/d") : "" }}</small>
                                    </div>
                                    <div class="col-10 mb-1 small">
                                        <small class="mb-1">{{ $group->posts->last() ? $group->posts->last()->user->name . ": " : "" }} </small>
                                        {{ $group->posts->last() ? $group->posts->last()->message : "" }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul></div>
            </div>
        </div>
        <main class="col-md-9 ms-sm-auto col-lg-9 p-0">
            @yield('content')
        </main>
    </div>
</div>


{{--Create Group Canvas--}}
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="createGroupOffcanvas" aria-labelledby="createGroupOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="createGroupOffcanvasLabel">Creat new group</h5>
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
                <div class="accordion" id="accordionGroup">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add users
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionGroup">
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
            <button type="submit" class="btn btn-secondary">Create</button>
        </form>
    </div>
</div>

{{--Search User Modal--}}
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

@include('layouts.footer')
