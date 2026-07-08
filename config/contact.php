<?php

/*
|--------------------------------------------------------------------------
| Datos de contacto públicos
|--------------------------------------------------------------------------
| Centraliza los datos que antes se leían con env() directamente en las
| vistas (footer, home). env() en vistas devuelve null cuando la config
| está cacheada (php artisan config:cache), por eso deben pasar por config().
*/

return [
    'email' => env('APP_CONTACT_EMAIL'),
    'phone' => env('APP_CONTACT_PHONE'),
    'location' => env('APP_CONTACT_LOCATION'),
    'github' => env('APP_GITHUB_URL', 'https://github.com/CarlosBTav'),
    'linkedin' => env('APP_LINKEDIN_URL', 'https://www.linkedin.com/in/carlos-b-6a8a9a2b5/'),
];
