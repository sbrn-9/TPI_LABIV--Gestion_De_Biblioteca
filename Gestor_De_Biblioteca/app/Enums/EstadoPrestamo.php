<?php

namespace App\Enums;

enum EstadoPrestamo: int
{
    case Pendiente = 0;
    case Activo = 1;
    case Cerrado = 2;
    case Atrasado = 3;
    //Estado del prestamo (Dependiendo el admin) aceptado, rechazado, cancelado
    case Cancelado = 4;
    case Rechazado = 5;
    case Aceptado = 6;

    function isPendente(): bool
    {
        return $this->value === self::Pendiente->value;
    }
    function isActivo(): bool
    {
        return $this->value === self::Activo->value;
    }
    function isCerrado(): bool
    {
        return $this->value === self::Cerrado->value;
    }

    function isAtrasado(): bool
    {
        return $this->value === self::Atrasado->value;
    }

    //Estadp del prestamo (Dependiendo el admin) aceptado, rechazado, cancelado
    function isAceptado(): bool
    {
        return $this->value === self::Aceptado->value;
    }
    function isRechazado(): bool
    {
        return $this->value === self::Rechazado->value;
    }
    function isCancelado(): bool
    {
        return $this->value === self::Cancelado->value;
    }
}
