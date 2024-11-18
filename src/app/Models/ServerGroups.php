<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ServerGroups extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public static function create(array $attributes = [])
    {
        return self::query()->create($attributes);
    }

    /** Получить группы сервров по пользователям
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUserServerGroups()
    {
        return $this->hasOne(UserServerGroups::class)->ofMany('server_group_id');
    }

    /** Получить список серверов
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getServers()
    {
        return $this->hasOne(Servers::class)->ofMany('server_group_id');
    }
}
