<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alarm; // تأكد من استيراد نموذج Alarm
use Illuminate\Support\Facades\Auth; // لاستيراد Auth للتحقق من المستخدم

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alarms = Alarm::where('user_id', Auth::id())->get();

        // تمرير المنبهات إلى صفحة home
        return view('home', compact('alarms'));
    }
}
