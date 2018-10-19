@if((new Jenssegers\Agent\Agent)->isMobile() || (new Jenssegers\Agent\Agent)->isTablet())
@include('layouts.mobile-header')
@else
@include('layouts.header')
@endif
@yield('content')
@include('layouts.footer')