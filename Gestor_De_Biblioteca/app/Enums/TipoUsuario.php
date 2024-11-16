<?php

namespace App\Enums;

enum TipoUsuario: int
{
    case Admin = 0;
    case Cliente = 1;

    public function isAdmin(): bool
	{
		return $this->value === self::Admin->value;
	}

	public function isCliente(): bool
	{
		return $this->value === self::Cliente->value;
	}
	public function getNombreTipo(): string
{
	return match($this) {
		self::Admin => 'Administrador',
		self::Cliente => 'Cliente',
	};
}
}
