<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $server_group_id
 * @property string $ssh_key
 * @property string $name
 * @property string $descriptions
 * @property string $login
 * @property int $port
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Servers extends Model
{
    protected $fillable = [
        'server_group_id',
        'ssh_key',
        'login',
        'name',
        'descriptions',
        'port'
    ];

    public static function create(array $attributes = []){
        return self::query()->create($attributes);
    }
    public function getServerKeys(){
        return $this->hasMany(ServerKeys::class,'server_id');
    }
}
