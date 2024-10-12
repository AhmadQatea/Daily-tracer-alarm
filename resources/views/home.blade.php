@extends('layouts.master')
@section('lisbar')
<div class="navbar-nav">
    <a class="l-navbar "  href="/">Home</a>
    <a class="l-navbar " href="/feature">Features</a>
    <a class="l-navbar  " href="/pricing">Pricing</a>
    @if (Auth::check())
    <li class="l-navbar dropdown">
        <a id="navbarDropdown" class="l-navbar dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item " href="/home">{{ Auth::user()->name }}</a>
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
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
        <h1 class="brand">Your Alarms</h1>
 
        <div class="row">
            @if($alarms->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No Alarms
                </div>
            @else
                @foreach($alarms as $alarm)
                    <div class="col-md-4">
                        <div class="card mb-4 {{ (new Date($alarm->today_date . ' ' . $alarm->wake_up_time) < new Date()) ? 'bg-danger text-white' : '' }}" style="background: #ededed; color: #3A6D8C;">
                            <div class="card-body">
                                <h5 class="card-title">Bedtime: {{ $alarm->bedtime }}</h5>
                                <p class="card-text">Wake Up Time: {{ $alarm->wake_up_time }}</p>
                                <p class="card-text">Date: {{ $alarm->today_date }}</p>
                                <p class="card-text" id="timer-{{ $alarm->id }}"></p> <!-- مؤقت الوقت -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('alarms.edit', $alarm->id) }}" class="btn btn-info mt-2">Edit</a>
                                    <form action="{{ route('alarms.destroy', $alarm->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this alarm?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // حساب وقت الاستيقاظ
                            const wakeUpTime = new Date('{{ $alarm->today_date }} {{ $alarm->wake_up_time }}').getTime();
                            const bedtime = new Date('{{ $alarm->today_date }} {{ $alarm->bedtime }}').getTime(); // إضافة وقت النوم
                            const timerElement = document.getElementById('timer-{{ $alarm->id }}');

                            // التحقق من وقت الاستيقا��
                            if (wakeUpTime <= bedtime) {
                                timerElement.innerHTML = "وقت الاستيقاظ يجب أن يكون بعد نصف ساعة من وقت النوم.";
                                return; // إيقاف المؤقت إذا كان الوقت غير صحيح
                            }

                            let hasRung = false; // متغير لتتبع ما إذا كان المنبه قد رن
                            let sound; // متغير لتخزين كائن الصوت

                            function updateTimer() {
                                const now = new Date().getTime();
                                const distance = wakeUpTime - now;

                                // حساب الساعات والدقائق والثواني
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                // عرض المؤقت
                                if (distance > 0) {
                                    timerElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
                                } else {
                                    clearInterval(timerInterval);
                                    if (!hasRung) {
                                        hasRung = true; // تعيين المتغير إلى true
                                        showAlarm(); // عرض نافذة المنبه
                                    }
                                }
                            }

                            const timerInterval = setInterval(updateTimer, 1000);

                            function showAlarm() {
                                // تشغيل صوت الرنين
                                sound = new Howl({
                                    src: ['sounds/sound.mp3'] // تأكد من وضع المسار الصحيح للصوت
                                });
                                sound.play();

                                // عرض نافذة منبثقة لإيقاف المنبه
                                const alarmModal = document.createElement('div');
                                alarmModal.innerHTML = `
                                    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">المنبه</h5>
                                                    <button type="button" class="close" onclick="closeAlarm()">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>الوقت للاستيقاظ!</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="closeAlarm()">إيقاف المنبه</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                document.body.appendChild(alarmModal);
                            }

                            window.closeAlarm = function() {
                                // إغلاق نافذة المنبه
                                const modal = document.querySelector('.modal');
                                if (modal) {
                                    modal.remove();
                                }
                                // إيقاف الصوت
                                if (sound) {
                                    sound.stop(); // تأكد من أن الصوت يتوقف
                                }
                                hasRung = false; // إعادة تعيين المتغير للسماح بتكرار المنبه في المستقبل
                            };
                        });
                    </script>
                @endforeach
            @endif
        </div>
    </div>
<a href="/create" class="btn btn-primary">Creat Alarm</a>
@endsection