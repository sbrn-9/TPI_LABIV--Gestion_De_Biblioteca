<?php

namespace App\Enums;

enum EstadoPrestamo: int
{
    case Pendiente = 0;
    case Activo = 1;
    case Cerrado = 2;
    case Atrasado = 3;
    case Cancelado = 4;

    function isPendiente(): bool
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

    function isCancelado(): bool
    {
        return $this->value === self::Cancelado->value;
    }
}
