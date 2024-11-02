<?php

namespace Database\Seeders;

use App\Models\Keys;
use App\Models\ServerGroups;
use App\Models\ServerKeys;
use App\Models\Servers;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserGroups;
use App\Models\UserServerGroups;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        Keys::insert([
            'name' => 'key1',
            'expire' => new Carbon('Now'),
            'active' => true
        ]);

        ServerGroups::insert([
            'name' => 'TestServerGroup',
            'description' => 'sadas'
        ]);

        Servers::insert([
            'server_group_id' => ServerGroups::query()->first()->id,
            'ssh_key' => 'skjdhfjshfjsd',
            'name' => 'Server1',
            'descriptions' => 'description',
            'login' => 'test',
            'port' => 22
        ]);

        ServerKeys::insert([
            'server_id' => Servers::query()->first()->id,
            'key_id' => Keys::query()->first()->id
        ]);

        UserServerGroups::insert([
            'server_group_id' => ServerGroups::query()->first()->id,
            'user_id' => User::query()->first()->id
        ]);

        UserGroups::insert([
            'user_id' => User::query()->first()->id,
            'name' => 'administrator',
            'permissions' => 'all'
        ]);
    }
}
