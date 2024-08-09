@include('layouts.header')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="form col-12 col-md-10 d-flex">

            @yield('content')

        </div>
    </div>
</div>

@include('layouts.footer')
