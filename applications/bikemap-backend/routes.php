<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);

    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get('/bikemap', function (
    Request $request,
    Response $response,
    array $args
) {
    $data = $this->get('db')
        ->table('bikes')
        ->leftJoin('reservations', 'reservations.bike_id', '=', 'bikes.id')
        ->get(['bikes.*', 'reservations.id as reservation_id', 'reservations.user_id as user_id']);

    $users = $this->get('db')
        ->table('users')
        ->join('reservations', 'users.id', '=', 'reservations.user_id')
        ->whereIn('reservations.bike_id', $data->pluck('id'))
        ->get(['users.*'])
        ->keyBy('id');

    foreach ($data as $bike) {
        if (!$bike->user_id) {
            $bike->user = null;
            continue;
        }

        $bike->user = $users->get($bike->user_id);
    }

    return $response
        ->withJson($data);
});

$app->post('/reservations/random/{bike_id}', function (
    Request $request,
    Response $response,
    array $args
) {
    $reservedUserIds = $this->get('db')
        ->table('reservations')
        ->get()
        ->pluck('user_id');

    $randomUser = $this->get('db')
        ->table('users')
        ->whereNotIn('id', $reservedUserIds)
        ->get()
        ->random(1)
        ->get(0);

    $this->get('db')
        ->table('reservations')
        ->insert([
            'bike_id' => (int) $args['bike_id'],
            'user_id' => $randomUser->id,
        ]);

    return $response;
});

$app->options('/reservations/{reservation_id}', function (
    Request $request,
    Response $response,
    array $args
) {
    return $response;
});

$app->delete('/reservations/{reservation_id}', function (
    Request $request,
    Response $response,
    array $args
) {
    $users = $this->get('db')
        ->table('reservations')
        ->where('id', (int) $args['reservation_id'])
        ->delete();

    return $response;
});
