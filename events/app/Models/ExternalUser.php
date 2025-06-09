<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ExternalUser extends Authenticatable
{
    protected $fillable = [
        'id', 'name', 'first_name', 'last_name', 'email', 'phone', 'music_genre', 'is_admin',
    ];

    public $timestamps = false;

    // Laravel domyślnie próbuje zapisać użytkownika w bazie — jeśli tego nie chcesz:
    public function save(array $options = [])
    {
        return true; // nadpisujemy save, żeby nic nie zapisywało
    }

    // wymagane przez Auth::login()
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return null; // bo nie logujesz się przez hasło
    }
}
