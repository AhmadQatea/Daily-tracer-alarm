@extends('layouts.master')
@section('lisbar')
<div class="navbar-nav">
    <a class="l-navbar "  href="/">Home</a>
    <a class="l-navbar " href="/feature">Features</a>
    <a class="l-navbar active" href="/pricing">Pricing</a>
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
<div class="pricing-container mt-5">
    <div class="pricing-card">
        <div class="brand">Basic Plan</div>
        <div class="price"><span class="old-price">$19.99</span> <span class="current-price">$9.99</span></div>
        <div class="features">
            <p>✔ Daily Sleep Tracking</p>
            <p>✔ Basic Sleep Reports</p>
            <p>✔ Community Support</p>
        </div>
        <button class="btn btn-primary">Subscribe</button>
    </div>
    <div class="pricing-card">
        <div class="brand">Standard Plan</div>
        <div class="price"><span class="old-price">$39.99</span> <span class="current-price">$19.99</span></div>
        <div class="features">
            <p>✔ All Basic Plan Features</p>
            <p>✔ Sleep Quality Analysis</p>
            <p>✔ Personalized Sleep Tips</p>
            <p>✔ Sleep Environment Analysis</p>
            <p>✔ Customizable Reminders</p>
        </div>
        <button class="btn btn-primary">Subscribe</button>
    </div>
    <div class="pricing-card">
        <div class="brand">Premium Plan</div>
        <div class="price"><span class="old-price">$59.99</span> <span class="current-price">$29.99</span></div>
        <div class="features">
            <p>✔ All Standard Plan Features</p>
            <p>✔ Smart Alarm</p>
            <p>✔ Integration with Wearables</p>
        </div>
        <button class="btn btn-primary">Subscribe</button>
    </div>
</div>
@endsection
