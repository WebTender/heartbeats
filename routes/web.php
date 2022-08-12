<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Heartbeat;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return env('APP_NAME', 'Heartbeats') . ' - ' . $router->app->version();
});
$router->get('/heartbeat/{uuid}', function ($uuid) use ($router) {
    $beat = Heartbeat::findOrFail($uuid);
    $beat->update(['last_pinged_at' => Carbon::now()]);
    return 'OK';
});
$router->get('/heartbeat-status/{uuid}', function ($uuid) use ($router) {
    $beat = Heartbeat::findOrFail($uuid);
    return response($beat, $beat->isOnline() ? 200 : 503);
});

if (env('ENABLE_CREATE')) {
    $router->get('/heartbeat-create', 'HeartbeatController@create');
}

if (env('ENABLE_LIST') || env('APP_DEBUG')) {
    $router->get('/list', function () use ($router) {
        throw new Exception('Testing 212');
        return Heartbeat::paginate();
    });
}
