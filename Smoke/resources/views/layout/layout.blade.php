<!DOCTYPE html>
<html lang="EN">

{{-- include head --}}
@include('inc.header')

<body>
        {{-- include nav baru --}}
        @include('inc.nav')

        {{-- extend contentu --}}
        @yield('content')
    
        {{-- include footeru --}}
        @include('inc.footer')
</body>

</html>