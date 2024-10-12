<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alarm; // تأكد من استيراد نموذج Alarm
use Illuminate\Support\Facades\Auth; // لاستيراد Auth للتحقق من المستخدم

class alarmsController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    } 

    public function create(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'bedtime' => 'required|date_format:H:i',
            'wake_up_time' => 'required|date_format:H:i',
            'date' => 'required|date',
        ]);

        // إنشاء سجل جديد في جدول alarms
        $alarm = new Alarm();
        $alarm->bedtime = $request->input('bedtime');
        $alarm->wake_up_time = $request->input('wake_up_time');
        $alarm->today_date = $request->input('date');
        $alarm->user_id = Auth::id(); // الحصول على ID المستخدم الحالي
        $alarm->save(); // حفظ السجل في قاعدة البيانات

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('home')->with('success', 'Alarm created successfully!');
    }
    public function show()
    {
        // الحصول على جميع المنبهات الخاصة بالمستخدم الحالي
        $alarms = Alarm::where('user_id', Auth::id())->get();

        // تمرير المنبهات إلى صفحة home
        return view('home', compact('alarms'));
    }
    
    public function destroy($id)
    {
        $alarm = Alarm::findOrFail($id);
        $alarm->delete();

        return redirect()->route('home')->with('success', 'Alarm deleted successfully!');
    }
    
    public function edit($id)
    {
        $alarm = Alarm::findOrFail($id);
        return view('pages.edit', compact('alarm'));
    }
    
    public function update(Request $request, $id)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'bedtime' => 'required|date_format:H:i',
            'wake_up_time' => 'required|date_format:H:i',
            'date' => 'required|date',
        ]);

        // العثور على المنبه وتحديثه
        $alarm = Alarm::findOrFail($id);
        $alarm->bedtime = $request->input('bedtime');
        $alarm->wake_up_time = $request->input('wake_up_time');
        $alarm->today_date = $request->input('date');
        $alarm->save(); // حفظ التغييرات

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('home')->with('success', 'Alarm updated successfully!');
    }
}
