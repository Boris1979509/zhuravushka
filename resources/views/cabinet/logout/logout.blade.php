<a class="link logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">{{ __('LogOut') }}</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
    @csrf
</form>
