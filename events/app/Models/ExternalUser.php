<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ExternalUser extends Authenticatable
{
    protected $fillable = [
        'id', 'name', 'first_name', 'last_name', 'email', 'phone', 'music_genre',
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->$key = $value;
            }
        }
    }
    
    public function save(array $options = []) { return true; }

    public function getAuthIdentifierName() { return 'id'; }

    public function getAuthIdentifier() { return $this->id; }

    public function getAuthPassword() { return null; }
}
