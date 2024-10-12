@extends('layouts.master')
@section('lisbar')
<div class="navbar-nav">
    <a class="l-navbar active"  href="/">Home</a>
    <a class="l-navbar " href="/feature">Features</a>
    <a class="l-navbar" href="/pricing">Pricing</a>
    @if (Auth::check())
    <li class="l-navbar dropdown">
        <a id="navbarDropdown" class="l-navbar dropdown-toggle" href="/profile" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/home">{{ Auth::user()->name }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
</li>
    @else
        <a class="l-navbar" href="/login">Login</a>
        <a class="l-navbar" href="/register">Register</a>
    @endif
  </div>
@endsection
@section('content')

<div class="info">
    <h2 class="title">Daily sleep tracker</h2>
    <p style="max-width: 600px;"> <!-- تعديل هنا -->
    Irregular sleeping patterns are a common issue affecting many individuals. Monitoring and tracking sleep quality and patterns are crucial for maintaining good health and mental well-being. Hence, the Sleep Patterns Tracking app is designed to meet users' needs in recording and monitoring sleep timings, including sleep duration and wake-up times.</p>
</div>
@endsection
@section('buttons')
<div class="buttons">
    @if (Auth::check())
    <a href="/create" class="btn home-btn">Creat Alarm</a>
    @else
    <a href="/login" class="btn home-btn">Subscribe</a>
    <a href="/register" class="btn home-btn-2">Free 7 Days</a>
    @endif
</div>
@endsection
@section('infos')
<h3 class="title-features mt-5">App Features</h3>
<div class="Features">
    <div class="left">
        <p><h4>Sleep Data Logging:</h4> <br> Users can easily record daily sleep timings, including bedtime and wake-up time.</p>
        <p><h4>Sleep Duration Tracking: </h4><br>The app clearly displays the sleep duration, helping users identify their average daily sleep hours.</p>
    </div>
    <div class="right">
        <p><h4>Add, Edit, and Delete Entries:</h4><br> An intuitive interface allows users to swiftly add, edit, or delete sleep data.</p>
        <p><h4>Monitoring Sleep Progress:</h4><br> Users can track the evolution of their sleep patterns over days and weeks, enabling them to take steps to enhance their sleep quality.</p>
    </div>
</div>    
@endsection
