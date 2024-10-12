@extends('layouts.master')
@section('lisbar')
<div class="navbar-nav">
    <a class="l-navbar "  href="/">Home</a>
    <a class="l-navbar active" href="/feature">Features</a>
    <a class="l-navbar" href="/pricing">Pricing</a>
    @if (Auth::check())
            <li class="l-navbar dropdown">
                                    <a id="navbarDropdown" class="l-navbar dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
<div class="features-container">
    <div class="feature-card">
        <h4>Smart Alarm:</h4>
        <p>The app features a smart alarm that wakes users during the lightest sleep phase for a more refreshing wake-up experience.</p>
    </div>
    <div class="feature-card">
        <h4>Sleep Quality Analysis:</h4>
        <p>Users receive insights and reports on their sleep quality, helping them understand factors affecting their rest.</p>
    </div>
    <div class="feature-card">
        <h4>Integration with Wearables:</h4>
        <p>The app can sync with wearable devices to provide more accurate sleep data and health metrics. <button class="btn btn-success mt-1 p-1">soon!</button></p>
    </div>
    <div class="feature-card">
        <h4>Personalized Sleep Tips:</h4>
        <p>Based on user data, the app offers tailored tips and recommendations to improve sleep habits.</p>
    </div>
    
    <div class="feature-card">
        <h4>Sleep Environment Analysis:</h4>
        <p>The app analyzes the sleep environment, providing tips on optimizing conditions for better sleep.</p>
    </div>
    
</div>
@endsection
