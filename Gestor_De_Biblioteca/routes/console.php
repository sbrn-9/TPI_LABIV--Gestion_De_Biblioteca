<?php

use App\Console\Commands\ActualizarPrestamoAtrasado;
use App\Enums\EstadoPrestamo;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:actualizar-prestamo-atrasado')->daily();
