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
<div class="time-card mt-5">
    <form method="POST" action="{{ route('alarms.update', $alarm->id) }}" onsubmit="return validateForm()">
        @csrf
        @method('PUT') <!-- استخدم PUT لتحديث السجل -->

        <div class="row mb-3">
            <label for="bedtime" class="col-md-4 col-form-label text-md-end">{{ __('Bedtime') }}</label>
            <div class="col-md-6">
                <input id="bedtime" type="time" class="form-control @error('bedtime') is-invalid @enderror" name="bedtime" value="{{ old('bedtime', $alarm->bedtime) }}" required>
                @error('bedtime')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="wake_up_time" class="col-md-4 col-form-label text-md-end">{{ __('Wake Up Time') }}</label>
            <div class="col-md-6">
                <input id="wake_up_time" type="time" class="form-control @error('wake_up_time') is-invalid @enderror" name="wake_up_time" value="{{ old('wake_up_time', $alarm->wake_up_time) }}" required>
                @error('wake_up_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Today\'s Date') }}</label>
            <div class="col-md-6">
                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $alarm->today_date) }}" required>
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    {{ __('Reset') }}
                </button>
                <button type="button" class="btn btn-danger mt-2" onclick="window.location.href='{{ url()->previous() }}'">
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
    function validateForm() {
        const bedtime = document.getElementById('bedtime').value;
        const wakeUpTime = document.getElementById('wake_up_time').value;
        const date = document.getElementById('date').value;

        const now = new Date();
        const currentDate = now.toISOString().split('T')[0]; // الحصول على التاريخ الحالي
        const currentTime = now.toTimeString().split(' ')[0].substring(0, 5); // الحصول على الوقت الحالي

        // التحقق من التاريخ
        if (date < currentDate) {
            alert("تاريخ المنبه يجب أن يكون اليوم أو بعده.");
            return false;
        }

        // التحقق من وقت النوم
        if (bedtime < currentTime) {
            alert("لا يمكن تحديد وقت النوم قبل الوقت الحالي.");
            return false;
        }

        // التحقق من وقت الاستيقاظ
        const bedtimeDateTime = new Date(date + 'T' + bedtime);
        const wakeUpDateTime = new Date(date + 'T' + wakeUpTime);
        const minWakeUpTime = new Date(bedtimeDateTime.getTime() + 1 * 60 * 1000); // إضافة 30 دقيقة

        if (wakeUpDateTime < minWakeUpTime) {
            alert("وقت الاستيقاظ يجب أن يكون بعد نصف ساعة من وقت النوم.");
            return false;
        }

        return true; // إذا كانت جميع الشروط صحيحة
    }

    function resetForm() {
        document.getElementById('bedtime').value = '';
        document.getElementById('wake_up_time').value = '';
        document.getElementById('date').value = '';

        // إزالة رسائل الخطأ
        const errorMessages = document.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(function(message) {
            message.style.display = 'none'; // أو يمكنك استخدام message.remove();
        });
    }
</script>