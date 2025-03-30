<?php

return [



    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'usuarios_alumno' => [
                'driver' => 'session',
                'provider' => 'usuarios_alumno',
            ],
        'empleador' => [
            'driver' => 'session',
            'provider' => 'empleadores',
        ],
        'vinculacion' => [
            'driver' => 'session',
            'provider' => 'vinculacion',
        ],
    ],


    
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\UsuariosAlumno::class,
        ],
        'usuarios_alumno' => [
        'driver' => 'eloquent',
        'model' => App\Models\UsuariosAlumno::class,
        ],
        'empleadores' => [
            'driver' => 'eloquent',
            'model' => App\Models\UsuariosEmpleador::class,
        ],
        'vinculacion' => [
            'driver' => 'eloquent',
            'model' => App\Models\UsuariosVinculacion::class,
        ],
    ],




    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
