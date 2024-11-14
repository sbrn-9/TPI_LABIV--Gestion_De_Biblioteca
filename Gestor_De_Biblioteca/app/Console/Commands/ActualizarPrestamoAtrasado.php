<?php

namespace App\Console\Commands;

use App\Enums\EstadoPrestamo;
use App\Models\Prestamo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ActualizarPrestamoAtrasado extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-prestamo-atrasado';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los prestamos que tienen fecha de devolución atrasada';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $atrasados = Prestamo::where('estado', EstadoPrestamo::Activo->value)
        ->where('fecha_devolucion', '<', today())
        ->get();
        foreach ($atrasados as $prestamo) {
            $prestamo->estado = EstadoPrestamo::Atrasado->value;
            $prestamo->save();
        }
        $this->info('Actualizado');
    }
}
