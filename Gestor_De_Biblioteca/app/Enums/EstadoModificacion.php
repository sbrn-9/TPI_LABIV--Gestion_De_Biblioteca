<?php

namespace App\Enums;

enum EstadoModificacion: string
{
    case Pendiente = 'pendiente';
    case Aprobado = 'aprobado';
    case Rechazado = 'rechazado';

    public function isPendiente(): bool
    {
        return $this->value === self::Pendiente->value;
    }

    public function isAprobado(): bool
    {
        return $this->value === self::Aprobado->value;
    }
    public function isRechazado(): bool
    {
        return $this->value === self::Rechazado->value;
    }
}
