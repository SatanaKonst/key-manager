<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $server_id
 * @property int $key_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ServerKeys extends Model
{

    public function getKey()
    {
        return $this->hasMany(Keys::class,'id','key_id');
    }
}
