<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Catat snapshot data ruangan setiap menit.
// Data saat ini berasal dari database aplikasi,
// belum dari sensor fisik.
Schedule::command('sensors:record')
    ->everyMinute()
    ->withoutOverlapping();
