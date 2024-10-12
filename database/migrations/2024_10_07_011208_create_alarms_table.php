<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alarms', function (Blueprint $table) {
            $table->id();
            $table->time('bedtime'); // عمود وقت النوم
            $table->time('wake_up_time'); // عمود وقت الاستيقاظ
            $table->date('today_date'); // عمود تاريخ اليوم
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // عمود id للمستخدم ك foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarms');
    }
}
