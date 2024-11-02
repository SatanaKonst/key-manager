<?php

use App\Models\Servers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    $servers = Servers::query()->get();
    foreach ($servers->all() as $server){
        $keys = $server->getServerKeys()->get();
        foreach ($keys as $key){
           $keyValue = $key->getKey()->get();
           dump($keyValue);
        }
    }
});
