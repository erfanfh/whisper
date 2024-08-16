@include('layouts.header')

<div class="d-flex">
    @auth()
        @include('layouts.sidebar')
    @endauth
    @guest()
        @include('layouts.navbar')
    @endguest
    <div class="row w-75 justify-content-center profile-right-sec">
        <div class="form col-12 col-md-10 d-flex">

            @yield('content')

        </div>
    </div>
</div>

@include('layouts.footer')
